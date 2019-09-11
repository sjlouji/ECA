<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class RegisterNewUserController extends Controller
{
    public function store(Request $request){
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->user_type=$request->user_type;
        $user->password=bcrypt($request->password);
        //  $curretTime = Carbon\Carbon::now();
        //  $user->created_at = $currentTime;
        Log::info($user);
        $user->save();
        Log::info(response()->json());
        return response()->json(['status' => 'SUCCESS', 'message' => "User Created Successfully"], 201);

    }

    public function storeUpdate(Request $request){
        $userId = $request->route('id');
        $user = User::find($userId);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->user_type=$request->user_type;
        $user->password = "admin";
        Log::info($user);

        $user->update();
        return response()->json(['status' => 'SUCCESS', 'message' => "User Updated Successfully"], 201);
    }
    public function data(Request $request){
        Log::info("working");
           $userDetails = DB::table('users')->select('id','name','email','user_type','created_at','updated_at')->get();
           Log::info($userDetails);
           return Datatables::of($userDetails)->make(true);
    }
    public function view(Request $request){
        $userId = $request->route('id');
        $user = User::find($userId);
        if(!$user){
            return "Page Not Found" ;
        }
        return view('admin.view')->with('user',$user);
    }
    public function edit(Request $request){
        $userId = $request->route('id');
        $user = User::find($userId);
        if(!$user){
            return "Page Not Found" ;
        }
        return view('admin.edit')->with('user',$user);
    }
}
