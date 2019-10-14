<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SelectionListModel;
use Maatwebsite\Excel\Facades\Excel;
use App\SelectionList;
use App\Year;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Log;
use App\cseselection;
use App\eceselection;
use App\eeeselection;
use App\mechselection;
use App\itselection;


class Selection extends Controller
{
    public function index(){
        $data = SelectionList::latest()->paginate(10);
        $year = DB::table('years')->select('year')->get();
        return view('selection.selections',compact('data'))->with('year',$year)->with('i',(request()->input('page',1)-1)*10);
    }
    public function import(Request $request){
        $yearjoin = $request->get('year_of_joining');
        $addyear = new Year();
        $addyear->year = $yearjoin;
        $addyear->save();
        Excel::import(new SelectionListModel, request()->file('file'));
        return back();
    }
    public function data(Request $request){
        $yearofadmission = $request->yearofadmission;

        $departmentDetails = DB::table('selection_lists')->Where('selection_lists.year_of_addmission',$yearofadmission)->select('id','year_of_addmission','application_no','student_name','catholic_or_non_catholic','calit_or_non_dalit','maths','physics','chemistry','cut_off','choice_1','choice_2','religion','community','caste','board','year_of_passing','father_name','father_designation','mother_name','mother_designation','monthly_income','father_mobile_no','mother_mobile_no')->orderBy('cut_off', 'desc')->get();
        return Datatables::of($departmentDetails)->escapeColumns([])
                                                 ->make(true);
    }
    public function view(Request $request){
        $userId = $request->route('id');
        $selection = SelectionList::find($userId);
        if(!$selection){
            return "Page Not Found" ;
        }
        return view('selection.viewuser')->with('department',$selection);
    }
    public function delete(Request $request){
        $user = SelectionList::find($request->id);
        $user->delete();
        return view('selection.selections');
    }
    public function edit(Request $request){
        $userId = $request->route('id');
        $user = SelectionList::find($userId);
        if(!$user){
            return "Page Not Found" ;
        }
        return view('selection.edituser')->with('user',$user);
    }
    public function update(Request $request){
        $user = SelectionList::find($request->id);
        $user->student_name=$request->stu_name;
        $user->catholic_or_non_catholic=$request->catholic_or_noncatholic;
        $user->calit_or_non_dalit=$request->dalith_or_nondalith;
        $user->maths=$request->maths;
        $user->physics=$request->physics;
        $user->chemistry=$request->chemistry;
        $user->choice_1=$request->choice_1;
        $user->choice_2=$request->choice_2;
        $user->cut_off=$request->cut_off;
        $user->religion=$request->religion;
        $user->community=$request->community;
        $user->caste=$request->caste;
        $user->board=$request->board;
        $user->father_name=$request->father_name;
        $user->father_designation=$request->father_designation;
        $user->mother_name=$request->mother_name;
        $user->mother_designation=$request->mother_designation;
        $user->monthly_income=$request->monthly_income;
        $user->father_mobile_no=$request->father_mobile_number;
        $user->mother_mobile_no=$request->mother_mobile_number;
        $user->update();
        return response()->json(['status' => 'SUCCESS', 'message' => "User Updated Successfully"], 201);
    }
    public function selectionList1(Request $request){
        if($request->yearofselection==NULL){
            return response()->json(['value' => 'Null Value Provided'], 404);
        }
        Log::info($request);

        $yearofadmission = $request->yearofselection;
        $departmentDetails = DB::table('selection_lists')->Where('selection_lists.year_of_addmission',$yearofadmission)->select('id','year_of_addmission','application_no','student_name','catholic_or_non_catholic','calit_or_non_dalit','maths','physics','chemistry','cut_off','choice_1','choice_2','religion','community','caste','board','year_of_passing','father_name','father_designation','mother_name','mother_designation','monthly_income','father_mobile_no','mother_mobile_no')->orderBy('cut_off', 'desc')->get();
        //Start of CSE Department selection List variables
        $cseDepartment = DB::table('departments')->where('departments.department_name','CSE')->select('department_name','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
        $cseOpenCatholic = $cseDepartment->total_seats_open_catholic;
        $cseRomanCatholic = $cseDepartment->total_seats_Roman_catholic;
        $cseDalithCatholic = $cseDepartment->total_seats_Dalit_catholic;
        $csePoor = $cseDepartment->total_seats_Rural_poor_students;
        //End of CSE Department selection List variables
        //Start of ECE Department selection List variables
        $eceDepartment = DB::table('departments')->where('departments.department_name','ECE')->select('department_name','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
        $eceOpenCatholic = $eceDepartment->total_seats_open_catholic;
        $eceRomanCatholic = $eceDepartment->total_seats_Roman_catholic;
        $eceDalithCatholic = $eceDepartment->total_seats_Dalit_catholic;
        $ecePoor = $eceDepartment->total_seats_Rural_poor_students;
        //End of ECE Department selection List variables
        //Start of MECH Department selection List variables
        $mechDepartment = DB::table('departments')->where('departments.department_name','MECH')->select('department_name','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
        $mechOpenCatholic = $mechDepartment->total_seats_open_catholic;
        $mechRomanCatholic = $mechDepartment->total_seats_Roman_catholic;
        $mechDalithCatholic = $mechDepartment->total_seats_Dalit_catholic;
        $mechPoor = $mechDepartment->total_seats_Rural_poor_students;
        //End of MECH Department selection List variables
        //Start of EEE Department selection List variables
        $eeeDepartment = DB::table('departments')->where('departments.department_name','EEE')->select('department_name','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
        $eeeOpenCatholic = $eeeDepartment->total_seats_open_catholic;
        $eeeRomanCatholic = $eeeDepartment->total_seats_Roman_catholic;
        $eeeDalithCatholic = $eeeDepartment->total_seats_Dalit_catholic;
        $eeePoor = $eeeDepartment->total_seats_Rural_poor_students;
        //End of EEE Department selection List variables
        //Start of IT Department selection List variables
        $itDepartment = DB::table('departments')->where('departments.department_name','IT')->select('department_name','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
        $itOpenCatholic = $itDepartment->total_seats_open_catholic;
        $itRomanCatholic = $itDepartment->total_seats_Roman_catholic;
        $itDalithCatholic = $itDepartment->total_seats_Dalit_catholic;
        $itPoor = $itDepartment->total_seats_Rural_poor_students;
        //End of IT Department selection List variables
        //Iterates till the end of selection_lists database
        foreach($departmentDetails as $department){
            $csedept = new cseselection();
            $ecedept = new eceselection();
            $eeedept = new eeeselection();
            $mechdept = new mechselection();
            $itdept = new itselection();
            //Start of Check if the user is Christian 
            if($department->religion=='Christian'){
                //Start Check if user is catholic or non catholic
                if($department->catholic_or_non_catholic=='c'){
                    //Start Check if user is Dalith or non dalith
                    if($department->calit_or_non_dalit=='D'){
                        if($department->choice_1=='CSE'){
                            if($cseDalithCatholic<=0){
                                //Choice 2 List Starts
                                if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($cseDalithCatholic>0){
                                $csedept->application_no = $department->application_no;                           
                                $csedept->student_name = $department->student_name;                           
                                $csedept->selection_ids = $department->id;                           
                                $csedept->year_of_addmission = $department->year_of_addmission;                           
                                $csedept->religion = $department->religion;                           
                                $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $csedept->cut_off = $department->cut_off; 
                                $csedept->save();
                                $cseDalithCatholic--;
                            }
                        }
                        elseif($department->choice_1=='ECE'){
                            if($eceDalithCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($eceDalithCatholic>0){
                                $ecedept->application_no = $department->application_no;                           
                                $ecedept->student_name = $department->student_name;                           
                                $ecedept->selection_ids = $department->id;                           
                                $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                $ecedept->religion = $department->religion;                           
                                $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $ecedept->cut_off = $department->cut_off; 
                                $ecedept->save();
                                $eceDalithCatholic--;
                            }
                        }
                        elseif($department->choice_1=='MECH'){
                            if($mechDalithCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($mechDalithCatholic>0){
                                $mechdept->application_no = $department->application_no;                           
                                $mechdept->student_name = $department->student_name;                           
                                $mechdept->selection_ids = $department->id;                           
                                $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                $mechdept->religion = $department->religion;                           
                                $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $mechdept->cut_off = $department->cut_off; 
                                $mechdept->save();
                                $mechDalithCatholic--;
                            }
                        }
                        elseif($department->choice_1=='EEE'){
                            if($eeeDalithCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($eeeDalithCatholic>0){
                                $eeedept->application_no = $department->application_no;                           
                                $eeedept->student_name = $department->student_name;                           
                                $eeedept->selection_ids = $department->id;                           
                                $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                $eeedept->religion = $department->religion;                           
                                $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $eeedept->cut_off = $department->cut_off; 
                                $eeedept->save();
                                $eeeDalithCatholic--;
                            }
                        }
                        elseif($department->choice_1=='IT'){
                            if($itDalithCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($itDalithCatholic>0){
                                $itdept->application_no = $department->application_no;                           
                                $itdept->student_name = $department->student_name;                           
                                $itdept->selection_ids = $department->id;                           
                                $itdept->year_of_addmission = $department->year_of_addmission;                           
                                $itdept->religion = $department->religion;                           
                                $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $itdept->cut_off = $department->cut_off; 
                                $itdept->save();
                                $itDalithCatholic--;
                            }
                        }
                    }
                    elseif($department->calit_or_non_dalit=='ND'){
                        if($department->choice_1=='CSE'){
                            if($cseRomanCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($cseRomanCatholic>0){
                                $csedept->application_no = $department->application_no;                           
                                $csedept->student_name = $department->student_name;                           
                                $csedept->selection_ids = $department->id;                           
                                $csedept->year_of_addmission = $department->year_of_addmission;                           
                                $csedept->religion = $department->religion;                           
                                $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $csedept->cut_off = $department->cut_off; 
                                $csedept->save();
                                $cseRomanCatholic--;
                            }
                        }
                        elseif($department->choice_1=='ECE'){
                            if($eceRomanCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($eceRomanCatholic>0){
                                $ecedept->application_no = $department->application_no;                           
                                $ecedept->student_name = $department->student_name;                           
                                $ecedept->selection_ids = $department->id;                           
                                $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                $ecedept->religion = $department->religion;                           
                                $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $ecedept->cut_off = $department->cut_off; 
                                $ecedept->save();
                                $eceRomanCatholic--;
                            }
                        }
                        elseif($department->choice_1=='MECH'){
                            if($mechRomanCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($mechRomanCatholic>0){
                                $mechdept->application_no = $department->application_no;                           
                                $mechdept->student_name = $department->student_name;                           
                                $mechdept->selection_ids = $department->id;                           
                                $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                $mechdept->religion = $department->religion;                           
                                $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $mechdept->cut_off = $department->cut_off; 
                                $mechdept->save();
                                $mechRomanCatholic--;
                            }
                        }
                        elseif($department->choice_1=='EEE'){
                            if($eeeRomanCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($eeeRomanCatholic>0){
                                $eeedept->application_no = $department->application_no;                           
                                $eeedept->student_name = $department->student_name;                           
                                $eeedept->selection_ids = $department->id;                           
                                $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                $eeedept->religion = $department->religion;                           
                                $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $eeedept->cut_off = $department->cut_off; 
                                $eeedept->save();
                                $eeeRomanCatholic--;
                            }
                        }
                        elseif($department->choice_1=='IT'){
                            if($itRomanCatholic<=0){
                                  //Choice 2 List Starts
                                  if($department->choice_2=='CSE'){
                                    if($cseDalithCatholic<=0){
                                        Log::info('List Expired in CSE');
                                    }
                                    elseif($cseDalithCatholic>0){
                                        $csedept->application_no = $department->application_no;                           
                                        $csedept->student_name = $department->student_name;                           
                                        $csedept->selection_ids = $department->id;                           
                                        $csedept->year_of_addmission = $department->year_of_addmission;                           
                                        $csedept->religion = $department->religion;                           
                                        $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $csedept->cut_off = $department->cut_off; 
                                        $csedept->save();
                                        $cseDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='ECE'){
                                    if($eceDalithCatholic<=0){
                                        Log::info('List Expired');
                                    }
                                    elseif($eceDalithCatholic>0){
                                        $ecedept->application_no = $department->application_no;                           
                                        $ecedept->student_name = $department->student_name;                           
                                        $ecedept->selection_ids = $department->id;                           
                                        $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                        $ecedept->religion = $department->religion;                           
                                        $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $ecedept->cut_off = $department->cut_off; 
                                        $ecedept->save();
                                        $eceDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='MECH'){
                                    if($mechDalithCatholic<=0){
                                        Log::info('List Expired in Mech');
                                    }
                                    elseif($mechDalithCatholic>0){
                                        $mechdept->application_no = $department->application_no;                           
                                        $mechdept->student_name = $department->student_name;                           
                                        $mechdept->selection_ids = $department->id;                           
                                        $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                        $mechdept->religion = $department->religion;                           
                                        $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $mechdept->cut_off = $department->cut_off; 
                                        $mechdept->save();
                                        $mechDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='EEE'){
                                    if($eeeDalithCatholic<=0){
                                        Log::info('List Expired in EEE');
                                    }
                                    elseif($eeeDalithCatholic>0){
                                        $eeedept->application_no = $department->application_no;                           
                                        $eeedept->student_name = $department->student_name;                           
                                        $eeedept->selection_ids = $department->id;                           
                                        $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                        $eeedept->religion = $department->religion;                           
                                        $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $eeedept->cut_off = $department->cut_off; 
                                        $eeedept->save();
                                        $eeeDalithCatholic--;
                                    }
                                }
                                elseif($department->choice_2=='IT'){
                                    if($itDalithCatholic<=0){
                                        Log::info('List Expired in IT');
                                    }
                                    elseif($itDalithCatholic>0){
                                        $itdept->application_no = $department->application_no;                           
                                        $itdept->student_name = $department->student_name;                           
                                        $itdept->selection_ids = $department->id;                           
                                        $itdept->year_of_addmission = $department->year_of_addmission;                           
                                        $itdept->religion = $department->religion;                           
                                        $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                        $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                        $itdept->cut_off = $department->cut_off; 
                                        $itdept->save();
                                        $itDalithCatholic--;
                                    }
                                }
                                else{
                                    Log::info($department->student_name.'Added to selection List 2');
                                }
                                //Choice 2 List ends
                            }
                            elseif($itRomanCatholic>0){
                                $itdept->application_no = $department->application_no;                           
                                $itdept->student_name = $department->student_name;                           
                                $itdept->selection_ids = $department->id;                           
                                $itdept->year_of_addmission = $department->year_of_addmission;                           
                                $itdept->religion = $department->religion;                           
                                $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                $itdept->cut_off = $department->cut_off; 
                                $itdept->save();
                                $itRomanCatholic--;
                            }
                        }
                    }
                    //End Check if user is Dalith or non dalith
                } //End Check if user is catholic or non catholic
            }//End of Checking if user is christian
            //Start of checking if user is Hindu
            elseif($department->religion=='Hindu'){
                if($department->calit_or_non_dalit=='D'){
                    if($department->choice_1=='CSE'){
                        if($cseDalithCatholic<=0){
                            //Choice 2 List Starts
                            if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($csePoor>0){
                            $csedept->application_no = $department->application_no;                           
                            $csedept->student_name = $department->student_name;                           
                            $csedept->selection_ids = $department->id;                           
                            $csedept->year_of_addmission = $department->year_of_addmission;                           
                            $csedept->religion = $department->religion;                           
                            $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $csedept->cut_off = $department->cut_off; 
                            $csedept->save();
                            $csePoor--;
                        }
                    }
                    elseif($department->choice_1=='ECE'){
                        if($ecePoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($ecePoor>0){
                            $ecedept->application_no = $department->application_no;                           
                            $ecedept->student_name = $department->student_name;                           
                            $ecedept->selection_ids = $department->id;                           
                            $ecedept->year_of_addmission = $department->year_of_addmission;                           
                            $ecedept->religion = $department->religion;                           
                            $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $ecedept->cut_off = $department->cut_off; 
                            $ecedept->save();
                            $ecePoor--;
                        }
                    }
                    elseif($department->choice_1=='MECH'){
                        if($mechPoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($mechPoor>0){
                            $mechdept->application_no = $department->application_no;                           
                            $mechdept->student_name = $department->student_name;                           
                            $mechdept->selection_ids = $department->id;                           
                            $mechdept->year_of_addmission = $department->year_of_addmission;                           
                            $mechdept->religion = $department->religion;                           
                            $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $mechdept->cut_off = $department->cut_off; 
                            $mechdept->save();
                            $mechPoor--;
                        }
                    }
                    elseif($department->choice_1=='EEE'){
                        if($eeePoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($eeePoor>0){
                            $eeedept->application_no = $department->application_no;                           
                            $eeedept->student_name = $department->student_name;                           
                            $eeedept->selection_ids = $department->id;                           
                            $eeedept->year_of_addmission = $department->year_of_addmission;                           
                            $eeedept->religion = $department->religion;                           
                            $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $eeedept->cut_off = $department->cut_off; 
                            $eeedept->save();
                            $eeePoor--;
                        }
                    }
                    elseif($department->choice_1=='IT'){
                        if($itPoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($itPoor>0){
                            $itdept->application_no = $department->application_no;                           
                            $itdept->student_name = $department->student_name;                           
                            $itdept->selection_ids = $department->id;                           
                            $itdept->year_of_addmission = $department->year_of_addmission;                           
                            $itdept->religion = $department->religion;                           
                            $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $itdept->cut_off = $department->cut_off; 
                            $itdept->save();
                            $itPoor--;
                        }
                    }
                }
            }//End of Checking if user is Hindu
            //Start of Checking if user is Muslim
            elseif($department->religion=='Muslim'){
                if($department->calit_or_non_dalit=='D'){
                    if($department->choice_1=='CSE'){
                        if($cseDalithCatholic<=0){
                            //Choice 2 List Starts
                            if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($csePoor>0){
                            $csedept->application_no = $department->application_no;                           
                            $csedept->student_name = $department->student_name;                           
                            $csedept->selection_ids = $department->id;                           
                            $csedept->year_of_addmission = $department->year_of_addmission;                           
                            $csedept->religion = $department->religion;                           
                            $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $csedept->cut_off = $department->cut_off; 
                            $csedept->save();
                            $csePoor--;
                        }
                    }
                    elseif($department->choice_1=='ECE'){
                        if($ecePoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($ecePoor>0){
                            $ecedept->application_no = $department->application_no;                           
                            $ecedept->student_name = $department->student_name;                           
                            $ecedept->selection_ids = $department->id;                           
                            $ecedept->year_of_addmission = $department->year_of_addmission;                           
                            $ecedept->religion = $department->religion;                           
                            $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $ecedept->cut_off = $department->cut_off; 
                            $ecedept->save();
                            $ecePoor--;
                        }
                    }
                    elseif($department->choice_1=='MECH'){
                        if($mechPoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($mechPoor>0){
                            $mechdept->application_no = $department->application_no;                           
                            $mechdept->student_name = $department->student_name;                           
                            $mechdept->selection_ids = $department->id;                           
                            $mechdept->year_of_addmission = $department->year_of_addmission;                           
                            $mechdept->religion = $department->religion;                           
                            $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $mechdept->cut_off = $department->cut_off; 
                            $mechdept->save();
                            $mechPoor--;
                        }
                    }
                    elseif($department->choice_1=='EEE'){
                        if($eeePoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->application_no = $department->application_no;                           
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($eeePoor>0){
                            $eeedept->application_no = $department->application_no;                           
                            $eeedept->student_name = $department->student_name;                           
                            $eeedept->selection_ids = $department->id;                           
                            $eeedept->year_of_addmission = $department->year_of_addmission;                           
                            $eeedept->religion = $department->religion;                           
                            $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $eeedept->cut_off = $department->cut_off; 
                            $eeedept->save();
                            $eeePoor--;
                        }
                    }
                    elseif($department->choice_1=='IT'){
                        if($itPoor<=0){
                              //Choice 2 List Starts
                              if($department->choice_2=='CSE'){
                                if($csePoor<=0){
                                    Log::info('List Expired in CSE');
                                }
                                elseif($csePoor>0){
                                    $csedept->application_no = $department->application_no;                           
                                    $csedept->student_name = $department->student_name;                           
                                    $csedept->selection_ids = $department->id;                           
                                    $csedept->year_of_addmission = $department->year_of_addmission;                           
                                    $csedept->religion = $department->religion;                           
                                    $csedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $csedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $csedept->cut_off = $department->cut_off; 
                                    $csedept->save();
                                    $csePoor--;
                                }
                            }
                            elseif($department->choice_2=='ECE'){
                                if($ecePoor<=0){
                                    Log::info('List Expired');
                                }
                                elseif($ecePoor>0){
                                    $ecedept->student_name = $department->student_name;                           
                                    $ecedept->selection_ids = $department->id;                           
                                    $ecedept->year_of_addmission = $department->year_of_addmission;                           
                                    $ecedept->religion = $department->religion;                           
                                    $ecedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $ecedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $ecedept->cut_off = $department->cut_off; 
                                    $ecedept->save();
                                    $ecePoor--;
                                }
                            }
                            elseif($department->choice_2=='MECH'){
                                if($mechPoor<=0){
                                    Log::info('List Expired in Mech');
                                }
                                elseif($mechPoor>0){
                                    $mechdept->application_no = $department->application_no;                           
                                    $mechdept->student_name = $department->student_name;                           
                                    $mechdept->selection_ids = $department->id;                           
                                    $mechdept->year_of_addmission = $department->year_of_addmission;                           
                                    $mechdept->religion = $department->religion;                           
                                    $mechdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $mechdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $mechdept->cut_off = $department->cut_off; 
                                    $mechdept->save();
                                    $mechPoor--;
                                }
                            }
                            elseif($department->choice_2=='EEE'){
                                if($eeePoor<=0){
                                    Log::info('List Expired in EEE');
                                }
                                elseif($eeePoor>0){
                                    $eeedept->application_no = $department->application_no;                           
                                    $eeedept->student_name = $department->student_name;                           
                                    $eeedept->selection_ids = $department->id;                           
                                    $eeedept->year_of_addmission = $department->year_of_addmission;                           
                                    $eeedept->religion = $department->religion;                           
                                    $eeedept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $eeedept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $eeedept->cut_off = $department->cut_off; 
                                    $eeedept->save();
                                    $eeePoor--;
                                }
                            }
                            elseif($department->choice_2=='IT'){
                                if($itPoor<=0){
                                    Log::info('List Expired in IT');
                                }
                                elseif($itPoor>0){
                                    $itdept->application_no = $department->application_no;                           
                                    $itdept->student_name = $department->student_name;                           
                                    $itdept->selection_ids = $department->id;                           
                                    $itdept->year_of_addmission = $department->year_of_addmission;                           
                                    $itdept->religion = $department->religion;                           
                                    $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                                    $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                                    $itdept->cut_off = $department->cut_off; 
                                    $itdept->save();
                                    $itPoor--;
                                }
                            }
                            else{
                                Log::info($department->student_name.'Added to selection List 2');
                            }
                            //Choice 2 List ends
                        }
                        elseif($itPoor>0){
                            $itdept->application_no = $department->application_no;                           
                            $itdept->student_name = $department->student_name;                           
                            $itdept->selection_ids = $department->id;                           
                            $itdept->year_of_addmission = $department->year_of_addmission;                           
                            $itdept->religion = $department->religion;                           
                            $itdept->catholic_or_non_catholic = $department->catholic_or_non_catholic;                           
                            $itdept->calit_or_non_dalit = $department->calit_or_non_dalit;                                                                   
                            $itdept->cut_off = $department->cut_off; 
                            $itdept->save();
                            $itPoor--;
                        }
                    }
                }
            }
            //End of Checking if user is Muslim
        }
        Log::info($cseOpenCatholic);
        Log::info($cseRomanCatholic);
        Log::info($cseDalithCatholic);
        Log::info($csePoor);

        Log::info($eceOpenCatholic);
        Log::info($eceRomanCatholic);
        Log::info($eceDalithCatholic);
        Log::info($ecePoor);

        Log::info($eeeOpenCatholic);
        Log::info($eeeRomanCatholic);
        Log::info($eeeDalithCatholic);
        Log::info($eeePoor);

        Log::info($mechOpenCatholic);
        Log::info($mechRomanCatholic);
        Log::info($mechDalithCatholic);
        Log::info($mechPoor);

        Log::info($itOpenCatholic);
        Log::info($itRomanCatholic);
        Log::info($itDalithCatholic);
        Log::info($itPoor);
        //End of the Iteration
    }

}
