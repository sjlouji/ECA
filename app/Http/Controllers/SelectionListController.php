<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Yajra\DataTables\DataTables;

class SelectionListController extends Controller
{
    public function index(){
        $department_name = DB::table('departments')->select('department_name')->get();
        Log::info($department_name);
        return view('selectionList.view')->with('department_name',$department_name);
    }

    public function selectionList1OQData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $departmentDetails = DB::table('selection_list1__open_quotas')->Where('selection_list1__open_quotas.department',$department)->select('id','student_id','student_name','department','cut_off','mode_choice')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }  

    public function selectionList1RCData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $departmentDetails = DB::table('selection_list1__roman_catholics')->Where('selection_list1__roman_catholics.department',$department)->select('id','student_id','student_name','department','cut_off','mode_choice')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }   

    public function selectionList1DCData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $departmentDetails = DB::table('selection_list1__dalith_catholics')->Where('selection_list1__dalith_catholics.department',$department)->select('id','student_id','student_name','department','cut_off','mode_choice')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    } 
    public function selectionList1RPData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $departmentDetails = DB::table('selection_list1__rural_and__poors')->Where('selection_list1__rural_and__poors.department',$department)->select('id','student_id','student_name','department','cut_off','mode_choice')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    } 
}
