<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Log;

class DepartmentController extends Controller
{
    public function add(Request $request){
        return view('admission.addDepartment');
    }
    public function store(Request $request){
            $department = new Department();
            $department->department_name = $request->department_name;
            $department->total_seats = $request->total_seats;
            $department->total_seats_management_quota = $request->total_seats_management_quota;
            $department->total_seats_open_catholic = $request->total_seats_open_catholic;
            $department->total_seats_Roman_catholic = $request->total_seats_Roman_catholic;
            $department->total_seats_Dalit_catholic = $request->total_seats_Dalit_catholic;
            $department->total_seats_Rural_poor_students = $request->total_seats_Rural_poor_students;
            Log::info($department);
            $department->save();
            return response()->json(['status' => 'SUCCESS', 'message' => "User Created Successfully"], 201);

    }
    public function data(Request $request){
        $departmentDetails = DB::table('departments')->select('id','department_name','total_seats','total_seats_management_quota','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }

    public function view(Request $request){
        $userId = $request->route('id');
        $department = Department::find($userId);
        if(!$department){
            return "Page Not Found" ;
        }
        return view('admission.viewdepartment')->with('department',$department);
    }
}
