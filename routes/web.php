<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

    // Check if user is logged in
    Route::get('/', function () {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    })->name('home');


Route::get('/home', 'HomeController@index')->name('home');


// User Routes Starts
Route::get('/register',function(){
    return view('admin.register');
})->middleware('can:isAdmin');
Route::get('/user', 'HomeController@user')->name('user')->middleware('can:isAdmin');
Route::post('/user/register/store','RegisterNewUserController@store')->middleware('can:isAdmin');
Route::get('/user/data', [ 'as' => 'user.data', 'uses' => 'RegisterNewUserController@data'])->middleware('can:isAdmin');
Route::get('/user/register/{id}/view','RegisterNewUserController@view')->middleware('can:isAdmin');
Route::get('/user/register/{id}/edit','RegisterNewUserController@edit')->middleware('can:isAdmin');
Route::get('/user/register/{id}/delete','RegisterNewUserController@delete')->middleware('can:isAdmin');
Route::post('/user/register/storeUpdate','RegisterNewUserController@storeUpdate')->middleware('can:isAdmin');
Route::get('/user/register/exports','RegisterNewUserController@exports')->middleware('can:isAdmin');
// User Routes Ends

// Department Routes Starts here
Route::get('/department',function(){
    return view('admission.department');
});
Route::get('/department/add', [ 'as' => 'department.add', 'uses' => 'DepartmentController@add'])->middleware('can:isAdmin');
Route::post('/department/add/store', [ 'as' => 'department.store', 'uses' => 'DepartmentController@store']);
Route::get('/department/data',[ 'as' => 'department.data', 'uses' => 'DepartmentController@data']);
Route::get('/department/add/{id}/view','DepartmentController@view');
Route::get('/department/add/{id}/edit','DepartmentController@edit');
Route::get('/department/add/{id}/delete','DepartmentController@delete')->middleware('can:isAdmin');
Route::post('/user/add/storeUpdate','DepartmentController@storeUpdate')->middleware('can:isAdmin');
// Department Routes Ends here

// Admission process routes starts
Route::get('/admission', 'Selection@index');
Route::post('/admission/import', 'Selection@import')->name('import');
Route::get('/admission/data',[ 'as' => 'admission.data', 'uses' => 'Selection@data']);
Route::get('/admission/selection/{id}/view', 'Selection@view')->middleware('can:isAdmin');
Route::get('/admission/selection/{id}/edit', 'Selection@edit')->middleware('can:isAdmin');
Route::get('/admission/selection/{id}/delete', 'Selection@delete')->middleware('can:isAdmin');
Route::post('/admission/selection/update','Selection@update')->middleware('can:isAdmin');
Route::post('/admission/selection/selectionList1','Selection@selectionList1')->middleware('can:isAdmin');
// Admission process routes ends

//Selection List Route Starts
Route::get('/selectionList', 'SelectionListController@index');
Route::get('/selectionList/selectionlist1OQ/data',[ 'as' => 'selectionList.selectionlist1OQ.data', 'uses' => 'SelectionListController@selectionList1OQData']);
Route::get('/selectionList/selectionlist1RC/data',[ 'as' => 'selectionList.selectionlist1RC.data', 'uses' => 'SelectionListController@selectionList1RCData']);
Route::get('/selectionList/selectionlist1DC/data',[ 'as' => 'selectionList.selectionlist1DC.data', 'uses' => 'SelectionListController@selectionList1DCData']);
Route::get('/selectionList/selectionlist1RP/data',[ 'as' => 'selectionList.selectionlist1RP.data', 'uses' => 'SelectionListController@selectionList1RPData']);
Route::get('/selectionList/selectionlist1OQ/','SelectionListController@selectionlist1OQExports')->middleware('can:isAdmin');
Route::get('/selectionList/selectionlist1RC/','SelectionListController@selectionlist1RCExports')->middleware('can:isAdmin');
Route::get('/selectionList/selectionlist1DC/','SelectionListController@selectionlist1DCExports')->middleware('can:isAdmin');
Route::get('/selectionList/selectionlist1RP/','SelectionListController@selectionlist1RPExports')->middleware('can:isAdmin');
Route::post('/selectionList/paidStatus/','SelectionListController@editPaidStaatus')->middleware('can:isAdmin');

//Selection List Route Ends

//Sms Template
Route::get('/sms', 'SmsController@index');
Route::get('/sms/add',[ 'as' => 'sms.add', 'uses' => 'SmsController@addTemplate']);
Route::post('/sms/addtemplate',[ 'as' => 'sms.addtemplate', 'uses' => 'SmsController@add']);
Route::get('/sms/data',[ 'as' => 'sms.data', 'uses' => 'SmsController@data']);
Route::get('/sms/{id}/delete','SmsController@delete');
Route::get('/sms/update','SmsController@editUpdate')->middleware('can:isAdmin');
Route::get('/sms/{id}/edit','SmsController@edit')->middleware('can:isAdmin');
Route::get('/sms/{id}/view','SmsController@view')->middleware('can:isAdmin');
//Sms Template