<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index(){
        return view('Sms.index');
    }

    public function addTemplate(Request $request){
        return view('Sms.addSms');
    }
}
