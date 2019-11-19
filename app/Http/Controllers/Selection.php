<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SelectionListModel;
use Maatwebsite\Excel\Facades\Excel;
use App\SelectionList;
use App\Year;
use Log;
use App\selection_list1__dalith_catholic;
use App\selection_list1__roman_catholic;
use App\selection_list1__rural_and__poor;
use App\selection_list1__open_quota;
use DB;
use Yajra\DataTables\DataTables;

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
        $departmentDetails = DB::table('selection_lists')->Where('selection_lists.year_of_addmission',$yearofadmission)->select('id','year_of_addmission','application_no','student_name','catholic_or_non_catholic','calit_or_non_dalit','maths','physics','chemistry','cut_off','choice_1','choice_2','religion','poor_or_not_poor','community','caste','board','year_of_passing','father_name','father_designation','mother_name','mother_designation','monthly_income','father_mobile_no','mother_mobile_no')->orderBy('cut_off', 'desc')->get();
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
        $departments = DB::table('departments')->select('id')->get();
        $yearofadmission = $request->yearofselection;
        $studentList = DB::table('selection_lists')->Where('selection_lists.year_of_addmission',$yearofadmission)->select('id','year_of_addmission','application_no','student_name','catholic_or_non_catholic','calit_or_non_dalit','maths','physics','chemistry','cut_off','choice_1','choice_2','religion','poor_or_not_poor','community','caste','board','year_of_passing','father_name','father_designation','mother_name','mother_designation','monthly_income','father_mobile_no','mother_mobile_no')->orderBy('cut_off', 'desc')->get();
        $count = 0;
        $dept_name = array();
        foreach($departments as $department){
            $department_name = DB::table('departments')->where('departments.id','=',$department->id)->select('department_name','total_seats','total_seats_management_quota','total_seats_open_catholic','total_seats_Roman_catholic','total_seats_Dalit_catholic','total_seats_Rural_poor_students')->first();
            ${$department_name->department_name} =  array();
            ${$department_name->department_name.'total_seats_opencatholic'} =  $department_name->total_seats_open_catholic;
            ${$department_name->department_name.'total_seats_Roman_catholic'} =  $department_name->total_seats_Roman_catholic;
            ${$department_name->department_name.'total_seats_Dalit_catholic'} =  $department_name->total_seats_Dalit_catholic;
            ${$department_name->department_name.'total_seats_Rural_poor_students'} =  $department_name->total_seats_Rural_poor_students;
            array_push($dept_name,array('department_name'=>$department_name->department_name,'other_cast'=>$department_name->total_seats_open_catholic,'Roman_catholic'=>$department_name->total_seats_Roman_catholic,'Dalith_catholic'=>$department_name->total_seats_Dalit_catholic,'Rural_and_Poor'=>$department_name->total_seats_Rural_poor_students));
            $count++;
        }
        foreach($studentList as $sele){
            $romanCatholicData = new selection_list1__roman_catholic();
            $dalithCatholicData = new selection_list1__dalith_catholic();
            $ruralandpoorData = new selection_list1__rural_and__poor();
            $openquotaData = new selection_list1__open_quota();

            foreach($dept_name as $dep){
                //Checking if the department name in the Selection list and the database matches
                if($sele->choice_1 == $dep['department_name']){
                    if(${$dep['department_name'].'total_seats_opencatholic'} <=0){
                        if($sele->catholic_or_non_catholic == 'NC'){
                            if($sele->poor_or_not_poor == 'P'){
                                if(${$dep['department_name'].'total_seats_Rural_poor_students'} <=0){
                                    //Selection list 2
                                    //Selection list 2
                                            foreach($dept_name as $dep){
                                                //Checking if the department name in the Selection list and the database matches
                                                if($sele->choice_2 == $dep['department_name']){
                                                    if(${$dep['department_name'].'total_seats_opencatholic'} <=0){
                                                        if($sele->catholic_or_non_catholic == 'NC'){
                                                            if($sele->poor_or_not_poor == 'P'){
                                                                if(${$dep['department_name'].'total_seats_Rural_poor_students'} <=0){
                                                                    Log::info($sele->student_name.''.'Not selected');
                                                                }elseif(${$dep['department_name'].'total_seats_Rural_poor_students'} >0){
                                                                    $ruralandpoorData->student_id = $sele->id;
                                                                    $ruralandpoorData->student_name = $sele->student_name;
                                                                    $ruralandpoorData->register_no = $sele->application_no;
                                                                    $ruralandpoorData->year_of_selection = $sele->year_of_addmission;
                                                                    $ruralandpoorData->department = $dep['department_name'];
                                                                    $ruralandpoorData->cut_off = $sele->cut_off;
                                                                    $ruralandpoorData->mode_choice = 'Choice 2';
                                                                    $ruralandpoorData->paid_stauts = 'Not_paid';
                                                                    $ruralandpoorData->save();
                                                                    Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Proverty or Rurality => choice 2');
                                                                    ${$dep['department_name'].'total_seats_Rural_poor_students'}--;
                                                                    Log::info(${$dep['department_name'].'total_seats_Rural_poor_students'});
                                                                }
                                                            }
                                                        }elseif($sele->catholic_or_non_catholic == 'c'){
                                                            if(${$dep['department_name'].'total_seats_Roman_catholic'} <=0){
                                                                if($sele->calit_or_non_dalit == 'D'){
                                                                    $dalithCatholicData->student_id = $sele->id;
                                                                    $dalithCatholicData->student_name = $sele->student_name;
                                                                    $dalithCatholicData->register_no = $sele->application_no;
                                                                    $dalithCatholicData->year_of_selection = $sele->year_of_addmission;
                                                                    $dalithCatholicData->department = $dep['department_name'];
                                                                    $dalithCatholicData->cut_off = $sele->cut_off;
                                                                    $dalithCatholicData->mode_choice = 'Choice 1';
                                                                    $dalithCatholicData->paid_stauts = 'Not_paid';
                                                                    $dalithCatholicData->save();
                                                                    Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Dalith Catholic => Choice 2');
                                                                    ${$dep['department_name'].'total_seats_Dalit_catholic'}--;
                                                                    Log::info(${$dep['department_name'].'total_seats_Dalit_catholic'});
                                                                }else{
                                                                    Log::info($sele->student_name.''.'Not Selected');
                                                                }
                                                            }elseif(${$dep['department_name'].'total_seats_Roman_catholic'} > 0){
                                                                $romanCatholicData->student_id = $sele->id;
                                                                $romanCatholicData->student_name = $sele->student_name;
                                                                $romanCatholicData->register_no = $sele->application_no;
                                                                $romanCatholicData->year_of_selection = $sele->year_of_addmission;
                                                                $romanCatholicData->department = $dep['department_name'];
                                                                $romanCatholicData->cut_off = $sele->cut_off;
                                                                $romanCatholicData->mode_choice = 'Choice 1';
                                                                $romanCatholicData->paid_stauts = 'Not_paid';
                                                                $romanCatholicData->save();
                                                                Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Roman Catholic => choice 2');
                                                                ${$dep['department_name'].'total_seats_Roman_catholic'}--;                                    
                                                                Log::info(${$dep['department_name'].'total_seats_Roman_catholic'});
                                                            }
                                                        }
                                                    }elseif(${$dep['department_name'].'total_seats_opencatholic'} >0){
                                                        $openquotaData->student_id = $sele->id;
                                                        $openquotaData->student_name = $sele->student_name;
                                                        $openquotaData->register_no = $sele->application_no;
                                                        $openquotaData->year_of_selection = $sele->year_of_addmission;
                                                        $openquotaData->department = $dep['department_name'];
                                                        $openquotaData->cut_off = $sele->cut_off;
                                                        $openquotaData->mode_choice = 'Choice 2';
                                                        $openquotaData->paid_stauts = 'Not_paid';
                                                        $openquotaData->save();
                                                        Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based of OpenQuota => Choice 2');
                                                        ${$dep['department_name'].'total_seats_opencatholic'}--;
                                                        Log::info(${$dep['department_name'].'total_seats_opencatholic'});
                                                    }
                                                }
                                            }
                                    //Selection list 2
                                    //Selection list 2
                                }elseif(${$dep['department_name'].'total_seats_Rural_poor_students'} >0){
                                    $ruralandpoorData->student_id = $sele->id;
                                    $ruralandpoorData->student_name = $sele->student_name;
                                    $ruralandpoorData->register_no = $sele->application_no;
                                    $ruralandpoorData->year_of_selection = $sele->year_of_addmission;
                                    $ruralandpoorData->department = $dep['department_name'];
                                    $ruralandpoorData->cut_off = $sele->cut_off;
                                    $ruralandpoorData->mode_choice = 'Choice 1';
                                    $ruralandpoorData->paid_stauts = 'Not_paid';
                                    $ruralandpoorData->save();
                                    Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Proverty or Rurality => choice 1');
                                    ${$dep['department_name'].'total_seats_Rural_poor_students'}--;
                                    Log::info(${$dep['department_name'].'total_seats_Rural_poor_students'});
                                }
                            }
                        }elseif($sele->catholic_or_non_catholic == 'c'){
                            if(${$dep['department_name'].'total_seats_Roman_catholic'} <=0){
                                if($sele->calit_or_non_dalit == 'D'){
                                    $dalithCatholicData->student_id = $sele->id;
                                    $dalithCatholicData->student_name = $sele->student_name;
                                    $dalithCatholicData->register_no = $sele->application_no;
                                    $dalithCatholicData->year_of_selection = $sele->year_of_addmission;
                                    $dalithCatholicData->department = $dep['department_name'];
                                    $dalithCatholicData->cut_off = $sele->cut_off;
                                    $dalithCatholicData->mode_choice = 'Choice 1';
                                    $dalithCatholicData->paid_stauts = 'Not_paid';
                                    $dalithCatholicData->save();
                                    Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Dalith Catholic => Choice 1');
                                    ${$dep['department_name'].'total_seats_Dalit_catholic'}--;
                                    Log::info(${$dep['department_name'].'total_seats_Dalit_catholic'});
                                }else{
                                    //Selection list 2
                                    //Selection list 2
                                    foreach($dept_name as $dep){
                                        //Checking if the department name in the Selection list and the database matches
                                        if($sele->choice_2 == $dep['department_name']){
                                            if(${$dep['department_name'].'total_seats_opencatholic'} <=0){
                                                if($sele->catholic_or_non_catholic == 'NC'){
                                                    if($sele->poor_or_not_poor == 'P'){
                                                        if(${$dep['department_name'].'total_seats_Rural_poor_students'} <=0){
                                                            Log::info($sele->stuent_name.''.'Not selected');
                                                        }elseif(${$dep['department_name'].'total_seats_Rural_poor_students'} >0){
                                                            $ruralandpoorData->student_id = $sele->id;
                                                            $ruralandpoorData->student_name = $sele->student_name;
                                                            $ruralandpoorData->register_no = $sele->application_no;
                                                            $ruralandpoorData->year_of_selection = $sele->year_of_addmission;
                                                            $ruralandpoorData->department = $dep['department_name'];
                                                            $ruralandpoorData->cut_off = $sele->cut_off;
                                                            $ruralandpoorData->mode_choice = 'Choice 2';
                                                            $ruralandpoorData->paid_stauts = 'Not_paid';
                                                            $ruralandpoorData->save();
                                                            Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Proverty or Rurality => choice 2');
                                                            ${$dep['department_name'].'total_seats_Rural_poor_students'}--;
                                                            Log::info(${$dep['department_name'].'total_seats_Rural_poor_students'});
                                                        }
                                                    }
                                                }elseif($sele->catholic_or_non_catholic == 'c'){
                                                    if(${$dep['department_name'].'total_seats_Roman_catholic'} <=0){
                                                        if($sele->calit_or_non_dalit == 'D'){
                                                            $dalithCatholicData->student_id = $sele->id;
                                                            $dalithCatholicData->student_name = $sele->student_name;
                                                            $dalithCatholicData->register_no = $sele->application_no;
                                                            $dalithCatholicData->year_of_selection = $sele->year_of_addmission;
                                                            $dalithCatholicData->department = $dep['department_name'];
                                                            $dalithCatholicData->cut_off = $sele->cut_off;
                                                            $dalithCatholicData->mode_choice = 'Choice 1';
                                                            $dalithCatholicData->paid_stauts = 'Not_paid';
                                                            $dalithCatholicData->save();
                                                            Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Dalith Catholic => Choice 2');
                                                            ${$dep['department_name'].'total_seats_Dalit_catholic'}--;
                                                            Log::info(${$dep['department_name'].'total_seats_Dalit_catholic'});
                                                        }else{
                                                            Log::info($sele->student_name.''.'Not Selected');
                                                        }
                                                    }elseif(${$dep['department_name'].'total_seats_Roman_catholic'} > 0){
                                                        $romanCatholicData->student_id = $sele->id;
                                                        $romanCatholicData->student_name = $sele->student_name;
                                                        $romanCatholicData->register_no = $sele->application_no;
                                                        $romanCatholicData->year_of_selection = $sele->year_of_addmission;
                                                        $romanCatholicData->department = $dep['department_name'];
                                                        $romanCatholicData->cut_off = $sele->cut_off;
                                                        $romanCatholicData->mode_choice = 'Choice 1';
                                                        $romanCatholicData->paid_stauts = 'Not_paid';
                                                        $romanCatholicData->save();
                                                        Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Roman Catholic => choice 2');
                                                        ${$dep['department_name'].'total_seats_Roman_catholic'}--;                                    
                                                        Log::info(${$dep['department_name'].'total_seats_Roman_catholic'});
                                                    }
                                                }
                                            }elseif(${$dep['department_name'].'total_seats_opencatholic'} >0){
                                                $openquotaData->student_id = $sele->id;
                                                $openquotaData->student_name = $sele->student_name;
                                                $openquotaData->register_no = $sele->application_no;
                                                $openquotaData->year_of_selection = $sele->year_of_addmission;
                                                $openquotaData->department = $dep['department_name'];
                                                $openquotaData->cut_off = $sele->cut_off;
                                                $openquotaData->mode_choice = 'Choice 2';
                                                $openquotaData->paid_stauts = 'Not_paid';
                                                $openquotaData->save();
                                                Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based of OpenQuota => Choice 2');
                                                ${$dep['department_name'].'total_seats_opencatholic'}--;
                                                Log::info(${$dep['department_name'].'total_seats_opencatholic'});
                                            }
                                        }
                                    }
                                    //Selection list 2
                                    //Selection list 2
                                }
                            }elseif(${$dep['department_name'].'total_seats_Roman_catholic'} > 0){
                                $romanCatholicData->student_id = $sele->id;
                                $romanCatholicData->student_name = $sele->student_name;
                                $romanCatholicData->register_no = $sele->application_no;
                                $romanCatholicData->year_of_selection = $sele->year_of_addmission;
                                $romanCatholicData->department = $dep['department_name'];
                                $romanCatholicData->cut_off = $sele->cut_off;
                                $romanCatholicData->mode_choice = 'Choice 1';
                                $romanCatholicData->paid_stauts = 'Not_paid';
                                $romanCatholicData->save();
                                Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based on Roman Catholic => choice 1');
                                ${$dep['department_name'].'total_seats_Roman_catholic'}--;                                    
                                Log::info(${$dep['department_name'].'total_seats_Roman_catholic'});
                            }
                        }
                    }elseif(${$dep['department_name'].'total_seats_opencatholic'} >0){
                        $openquotaData->student_id = $sele->id;
                        $openquotaData->student_name = $sele->student_name;
                        $openquotaData->register_no = $sele->application_no;
                        $openquotaData->year_of_selection = $sele->year_of_addmission;
                        $openquotaData->department = $dep['department_name'];
                        $openquotaData->cut_off = $sele->cut_off;
                        $openquotaData->mode_choice = 'Choice 1';
                        $openquotaData->paid_stauts = 'Not_paid';
                        $openquotaData->save();
                        Log::info($sele->student_name.'selected for the department'.$dep['department_name'].  'Based of OpenQuota => Choice 1');
                        ${$dep['department_name'].'total_seats_opencatholic'}--;
                        Log::info(${$dep['department_name'].'total_seats_opencatholic'});
                    }
                }
            }
            // Log::info(${$department_name->department_name.'total_seats_Roman_catholic'});

        }
    }

}
