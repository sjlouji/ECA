<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\SmsModel;
use Auth;
use DB;
use Yajra\DataTables\DataTables;


class SmsController extends Controller
{
    public function index(){
        return view('Sms.index');
    }

    public function addTemplate(Request $request){
        return view('Sms.addSms');
    }

    public function add(Request $request){
        $user = Auth::user();
        $smsTempAdd = new SmsModel();
        $smsTempAdd->template_name = $request->template_name;
        $smsTempAdd->message = $request->placeholder_text;
        $smsTempAdd->created_by = $user->id;
        $smsTempAdd->save();
        Log::info($smsTempAdd);
        return response()->json(['status' => 'SUCCESS', 'message' => "Template Added successfully"], 201);
    }

    public function data(Request $request){
        $data = DB::table('sms_models')
                                    ->leftjoin('users','sms_models.created_by','=','users.id')
                                    ->select('sms_models.id as id','sms_models.template_name as template_name','sms_models.message as message','users.name as name','sms_models.created_at as created_at','sms_models.updated_at as update_at')->get();
        return Datatables::of($data)->make(true);
    }

    public function edit(Request $request){
        $templateId = $request->route('id');
        $template = SmsModel::find($templateId);
        if(!$template){
            return "Page Not Found" ;
        }
        return view('Sms.edit')->with('template',$template);
    }

    public function view(Request $request){
        $templateId = $request->route('id');
        $template = SmsModel::find($templateId);
        if(!$template){
            return "Page Not Found" ;
        }

        $data = DB::table('users')->where('users.id',$template->created_by)->select('users.name')->get();
        Log::info($data);
        return view('Sms.view')->with('template',$template)->with('data',$data);
    }

    public function delete(Request $request){
        Log::info($request);
        $template = SmsModel::find($request->id);
        $template->delete();
        return view('Sms.index');
    }
}
