<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SelectionListModel;
use Maatwebsite\Excel\Facades\Excel;
use App\SelectionList;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Log;

class Selection extends Controller
{
    public function index(){
        $data = SelectionList::latest()->paginate(10);
        return view('selection.selections',compact('data'))->with('i',(request()->input('page',1)-1)*10);
    }
    public function import(){
        Excel::import(new SelectionListModel, request()->file('file'));
        return back();
    }
    public function data(Request $request){
        $departmentDetails = DB::table('selection_lists')->select('id','year_of_addmission','application_no','student_name','catholic_or_non_catholic','calit_or_non_dalit','maths','physics','chemistry','cut_off','choice_1','choice_2','religion','community','caste','board','year_of_passing','father_name','father_designation','mother_name','mother_designation','monthly_income','father_mobile_no','mother_mobile_no')->get();
        Log::info($departmentDetails);
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }
}
