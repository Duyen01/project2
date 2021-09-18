<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Student;
use App\Models\Bill;
use App\Models\Grade;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "Hello Cau";
        $key = $request->get('key');
        $bill = DB::table('bill')
        ->select('bill.*','student.firstname as firstname','student.lastname as lastname','admin.name as admin','student.email as email','student.id as idStudent')
        ->orderBy('bill.dateTime','DESC')
        ->join('student','idStudent','=','student.id')
        ->join('admin','idAdmin','=','admin.id')
        ->where('firstname','like', "%$key%")
        ->orwhere('lastname','like',"%$key%")
        ->paginate(5);
        return view('admin.bill.index', compact('bill','key'));
    }
    public function create(Request $request)
    {
        $grade = Grade::all();
        $search = $request->search;
        $student = Student::orderBy('id', 'ASC')->search()->paginate(5);
        return view('admin.bill.create', compact('student', 'search', 'grade'));
    }
    public function filter(Request $request, $idGrade)
    {
        $grade = Grade::all();
        $search = $request->search;
        $student = Student::select('student.*')
            ->join('grade', 'grade.id', '=', 'student.idGrade')
            ->where('grade.id', $idGrade)
            ->Search()->paginate(5);
        return view('admin.bill.create', compact('student', 'search', 'grade'));
    }
    public function add(Request $rq)
    {
        $id = $rq->id;
        $student = Student::select('student.id as idStudent','typepay.id as idTypePay','typepay.typeofpay as typeofpay','student.firstname as firstname','student.lastname as lastname')
        ->join('typepay', 'student.idTypePay', '=', 'typepay.id')
        // ->join('bill','student.id','=','bill.idStudent')
        ->where('student.id','=',$id)->first();
        $studentTuition = Student::join('LIST_TUITION', 'LIST_TUITION.id', '=', 'student.idGrade')->where('student.id', $id)->first();
        $studentScholarship = Student::join('scholarship', 'scholarship.id', '=', 'student.idScholarship')->where('student.id', $id)->first();

        return response()->json([
           "student" => $student,
           "studentTuition" => $studentTuition,
           "studentScholarship" => $studentScholarship,
       ]);
    }
    public function store(Request $request)
    {
        $data = $request->only('idStudent', 'idTypePay', 'idAdmin', 'money', 'note');
        // $idStudent = $request->get('idStudent');
        // // $idStudent = $request->get('idStudent');
        // die($idStudent);
        if(Bill::create($data)){
            return redirect()->route('bill.index')->with('success','Add bill success');;
        }
    }
    public function detail($id)
    {
        $student = Bill::join('student', 'student.id', '=', 'bill.idStudent')->where('student.id', $id)->get();
        // dd($student);

        return response()->json([
            "student" => $student,
        ]);
    }
}
