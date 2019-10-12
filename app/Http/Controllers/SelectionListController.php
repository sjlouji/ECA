<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectionListController extends Controller
{
    public function index(){
        return view('selectionList.view');
    }
}
