<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Yajra\DataTables\DataTables;
use App\Exports;
use App\selection_list1__dalith_catholic;
use App\selection_list1__open_quota;
use App\selection_list1__roman_catholic;
use App\selection_list1__rural_and__poor;

class SelectionListController extends Controller
{
    public function index(){
        $department_name = DB::table('departments')->select('department_name')->get();
        $year = DB::table('years')->select('year')->get();
        Log::info($department_name);
        return view('selectionList.view')->with('department_name',$department_name)->with('year',$year);
    }

    public function selectionList1OQData(Request $request){
        $department = $request->department_name;
        $year = $request->year_of_selection;
        Log::info($department);
        $departmentDetails = DB::table('selection_list1__open_quotas')->Where('selection_list1__open_quotas.department',$department)
                                                                      ->where('selection_list1__open_quotas.year_of_selection',$year)
                                                                      ->select('id','student_id','student_name','department','cut_off','mode_choice','paid_stauts')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }  

    public function selectionList1RCData(Request $request){
        $department = $request->department_name;
        $year = $request->year_of_selection;
        Log::info('year'.$year);
        $departmentDetails = DB::table('selection_list1__roman_catholics')
                                                                    ->Where('selection_list1__roman_catholics.department',$department)
                                                                    ->where('selection_list1__roman_catholics.year_of_selection',$year)
                                                                    ->select('id','student_id','student_name','department','cut_off','mode_choice','paid_stauts')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }   

    public function selectionList1DCData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $year = $request->year_of_selection;
        $departmentDetails = DB::table('selection_list1__dalith_catholics')
                                                                    ->Where('selection_list1__dalith_catholics.department',$department)
                                                                    ->where('selection_list1__dalith_catholics.year_of_selection',$year)
                                                                    ->select('id','student_id','student_name','department','cut_off','mode_choice','paid_stauts')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    } 
    public function selectionList1RPData(Request $request){
        $department = $request->department_name;
        Log::info($department);
        $year = $request->year_of_selection;
        $departmentDetails = DB::table('selection_list1__rural_and__poors')
                                                                    ->Where('selection_list1__rural_and__poors.department',$department)
                                                                    ->where('selection_list1__rural_and__poors.year_of_selection',$year)
                                                                    ->select('id','student_id','student_name','department','cut_off','mode_choice','paid_stauts')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    } 

    public function editPaidStaatus(Request $request){
        Log::info($request);
        if($request->quota=='selection_list1__open_quotas'){
            foreach($request->id as $val){
                $dep = selection_list1__open_quota::find($val);
                $dep->update(['paid_stauts'=>'Paid']);
            }
            return response()->json(['status' => 'SUCCESS', 'message' => "Paid Status Updated Successfully"], 201);
        }
        elseif($request->quota=='selection_list1__rural_and__poors'){
                foreach($request->id as $val){
                    $dep = selection_list1__rural_and__poor::find($val);
                    $dep->update(['paid_stauts'=>'Paid']);
                }
                return response()->json(['status' => 'SUCCESS', 'message' => "Paid Status Updated Successfully"], 201);
        }
        elseif($request->quota=='selection_list1__dalith_catholics'){
            foreach($request->id as $val){
                $dep = selection_list1__dalith_catholic::find($val);
                $dep->update(['paid_stauts'=>'Paid']);
            }
            return response()->json(['status' => 'SUCCESS', 'message' => "Paid Status Updated Successfully"], 201);
        }
        elseif($request->quota=='selection_list1__roman_catholics'){
            foreach($request->id as $val){
                $dep = selection_list1__roman_catholic::find($val);
                $dep->update(['paid_stauts'=>'Paid']);
            }
            return response()->json(['status' => 'SUCCESS', 'message' => "Paid Status Updated Successfully"], 201);

        }       
    }

    public function selectionlist1OQExports(){
        
    }

    public function selectionlist1RCExports(){
        
    }

    public function selectionlist1DCExports(){
        return Excel::download(new Exports\selectionlist1DCExports, 'dalith.csv');
    }

    public function selectionlist1RPExports(){
        
    }
}
