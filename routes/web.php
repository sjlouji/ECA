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
        return view('auth.register');
    })->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'HomeController@user')->name('user')->middleware('can:isAdmin');
Route::get('/register',function(){
    return view('admin.register');
})->middleware('can:isAdmin');
Route::post('/user/register/data','HomeController@data')->middleware('can@isAdmin');