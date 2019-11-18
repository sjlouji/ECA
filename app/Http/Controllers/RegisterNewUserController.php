<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\User;
use App\Exports;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

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
        $user = User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->user_type=$request->user_type;
        $user->update();
        return response()->json(['status' => 'SUCCESS', 'message' => "User Updated Successfully"], 201);
    }
    public function data(Request $request){
        // Log::info("working");
           $userDetails = DB::table('users')->select('id','name','email','user_type','created_at','updated_at')->get();
        //    Log::info($userDetails);
           return Datatables::of($userDetails)->make(true);
    }
    public function view(Request $request){
        $userId = $request->route('id');
        Log::info($userId);
        $user = User::find($userId);
        if(!$user){
            return "Page Not Found" ;
        }
        return view('admin.view')->with('user',$user);
    }
    public function edit(Request $request){
        $userId = $request->route('id');
        $user = User::find($userId);
        // Log::info($user);
        if(!$user){
            return "Page Not Found" ;
        }
        return view('admin.edit')->with('user',$user);
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return view('admin.users');
    }
    public function exports(){
        return Excel::download(new Exports\CsvExport, 'users.csv');
    }
}
