<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Scholarship;
use App\Models\TypePay;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;



class StudentController extends Controller
{
    //Login
    public function login(){
        return view('login');
    }
    //processLogin
    public function loginProcess(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        try{
            $student = Student::where('email', '=', $email)->first();
            $newPass = $student->password;
            if (Hash::needsRehash($newPass)) {
                $newPass = Hash::make($newPass);
            }
            if (Hash::check($password, $newPass)) {
                // code...
                $request->session()->put('student', $student);
                return Redirect::route('welcome')->with('success','Đăng nhập thành công');
            }else{
                return Redirect::route('login')->with('error','Sai du lieu');
            }
        }catch(Exception $e){
            echo "Dang nhap that bai";
            return Redirect::route('login')->with('error','Sai du lieu');
        }
       
    }
    //Log out
     public function logout(Request $request){
        $request->session()->flush();
        return Redirect::route('login');
    }
    //Import function
    public function import(Request $request)
    {
        
        if ($request->file('imported_file')) {
            Excel::import(new StudentsImport(), request()->file('imported_file'));
            return back()->with('success','Imported Successfully');
        }
    }
    //Export function
    public function export(Request $request)
    {
        $request->validate([
            'grade' => 'required',
        ]);

        $id = $request -> get('grade');
        $file = Excel::download(new StudentsExport($id), 'students_'.time().'.xlsx');
        return $file;
    }
    // //View profile student
    public function profile(Request $request){
        $id = $request->session()->get('student.id');
        $student = Student::find($id);
        return view('student.profile', compact('student'));
    }
    //Change pass student
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'oldpassword.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',     
        ], $messages);

        return $validator;
    }  
    public function changePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',   
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $student= new Student();
       
        $student->password=$request->get('password');
       
        $student->save();
   
        return response()->json(['success'=>'Data is successfully added']);
    }
    //End change pass
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->get('key');
        $grades = Grade::orderBy('name','ASC')->get();
        $data = Student::orderBy('id', 'ASC')->where('firstname','like', "%$key%")->orwhere('lastname','like', "%$key%")->get();
        return view('admin.student.index', compact('data', 'key','grades'));
    }
    public function search(Request $request)
    {
        {
        if ($request->ajax()) {
            $key = $request->get('key');//Key tim kiem
            if(!empty($request-> get('idGrade'))){
                $idGrade = $request -> get('idGrade');//Key theo lop
                $data = Student::select('student.*','grade.name as nameGrade','scholarship.money as money','typepay.typeofpay as typeofpay')
            ->join('grade','idGrade','=','grade.id')
            ->join('scholarship','idScholarship','=','scholarship.id')
            ->join('typepay','idTypePay','=','typepay.id')
            ->where('idGrade',$idGrade)
            ->where('firstname','like', "%$key%")->orwhere('lastname','like', "%$key%")->get();
            }else{
                $data = Student::select('student.*','grade.name as nameGrade','scholarship.money as money','typepay.typeofpay as typeofpay')
            ->join('grade','idGrade','=','grade.id')
            ->join('scholarship','idScholarship','=','scholarship.id')
            ->join('typepay','idTypePay','=','typepay.id')
            ->where('firstname','like', "%$key%")->orwhere('lastname','like', "%$key%")->get();
            }
           
            $output = '';
            if ($data) {
                foreach ($data as $key => $student) {
                    $gender = $student->gender == 1? "Nam":"Nữ";
                    $link_edit = route('student.edit',$student->id);
                    $output .= '<tr>
                    <td>' . $student->firstname . '</td>
                    <td>' . $student->lastname . '</td>
                    <td>' . $gender . '</td>
                    <td>' . $student->nameGrade . '</td>
                    <td>' . $student->email . '</td>
                    <td>' . $student->address . '</td>
                    <td>' . $student->phone . '</td>
                    <td>' . $student->dob . '</td>
                    <td>' . number_format($student->money) . '</td>
                    <td>' . $student->typeofpay . '</td>
                    <td>' . '<a href="'.$link_edit.'"><i class="fas fa-edit"></i></a>' . '</td>
                    </tr>';
                }
            }
            
            return Response($output);
        }
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grade = Grade::orderBy('name', 'ASC')->select('id', 'name')->get();
        $typepay = TypePay::orderBy('typeOfPay', 'ASC')->select('id', 'typeOfPay')->get();
        $scholarship = Scholarship::orderBy('money', 'ASC')->select('id', 'money')->get();
        return view('admin.student.create', compact('grade', 'typepay', 'scholarship'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $this->validate($request, [
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'gender' => 'required',
            'address' => 'required|min:2',
            'phone' => 'required|min:9|max:15',
            'dob' => 'required',
            'idGrade' => 'required',
            'idScholarship' => 'required',
            'idTypePay' => 'required',
            // 'status' => 'required',
            'email' => 'unique:student',
            'password' => 'required'
        ]);
        $student -> firstName = $request->get('firstName');
        $student -> lastName = $request->get('lastName');
        $student -> gender = $request-> get('gender');
        $student -> address = $request-> get('address');
        $student -> phone = $request-> get('phone');
        $student -> dob = $request-> get('dob');
        $student -> idGrade = $request-> get('idGrade');
        $student -> idScholarship = $request-> get('idScholarship');
        $student -> idTypePay = $request-> get('idTypePay');
        $student -> email = $request-> get('email');
        //Hash password
        // $student -> status = $request-> get('status');
        $password = $request->get('password');
        $password = Hash::make($password);
        $student -> password = $password;
        //End hash

        $student -> save();
        return redirect()->route('student.index')->with('success','Create a new student success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $grade = Grade::all();
        $scholarship = Scholarship::all();
        $typepay = TypePay::all();
        return view('admin.student.edit',compact('student', 'grade', 'scholarship', 'typepay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = new Student();
        $student = Student::find($id);
        $student -> firstName = $request->get('firstName');
        $student -> lastName = $request->get('lastName');
        $student -> gender = $request-> get('gender');
        $student -> idGrade = $request-> get('idGrade');
        $student -> idScholarship = $request-> get('idScholarship');
        $student -> idTypePay = $request-> get('idTypePay');
        $student -> email = $request-> get('email');
        $student -> phone = $request-> get('phone');
        //Hash password
        if(!empty($request->get('password'))){
            $password = $request-> get('phone');
            $password = Hash::make($password);
            $student -> password = $password;
        }
        
        //End hash
        $student->save();
        return redirect(route('student.index'))->with('success','Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Student::find($id)->delete();
        return redirect(route('student.index'))->with('success','Xóa thành công!');
    }
}
