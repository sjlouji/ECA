<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterNewUserController extends Controller
{
    public function data(Request $request){
        Log::info($request);
    }
}
