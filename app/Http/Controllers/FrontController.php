<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Bill;
// use App\Models\Student;
// use App\Models\Admin;
use App\Models\TypePay;
use Mail;
class FrontController extends Controller
{
    public function addFeedback(Request $request)
    {
        $id = $request->get('idBill');
        $bill = Bill::find($id);
        $idTypepay = $bill->idTypepay;
        $typepay = TypePay::where('id',$idTypepay)->first();
         // $pathToFile = asset('home/robin/Downloads/TVD/public/ad/dist/img/admin.jpg');
        // dd($typepay);
        $email = $bill->student->email;
        Mail::send('mailfb', compact('bill','typepay'), function($message) use ($email){
            // $message->attach($pathToFile);
            $message->to($email)->subject('Học phí sinh viên');
            // $message->to($email, $name);
        });
        return Redirect::route('bill.index')->with('success','Đã gửi email!');
    }
}