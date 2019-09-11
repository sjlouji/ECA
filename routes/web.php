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

Route::get('/', function () {
    return view('home');
});

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
Route::post('/user/register/storeUpdate','RegisterNewUserController@storeUpdate')->middleware('can:isAdmin');
// User Routes Ends

// Department Routes Starts here
Route::get('/department',function(){
    return view('admission.department');
});
Route::get('/department/add', [ 'as' => 'department.add', 'uses' => 'DepartmentController@add'])->middleware('can:isAdmin');
Route::post('/department/add/store', [ 'as' => 'department.store', 'uses' => 'DepartmentController@store']);
Route::get('/department/data',[ 'as' => 'department.data', 'uses' => 'DepartmentController@data']);
Route::get('/department/add/{id}/view','DepartmentController@view');
// Department Routes Ends here

// Admission process routes starts
Route::get('/admission',function(){
    return view('admission.admissionProcess');
});
// Admission process routes ends

