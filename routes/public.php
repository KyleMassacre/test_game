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


//Route::get('/', function () {
//    $user = \App\User::find(1);
//    $user->saveStat('Experience', ['value' => 61]);
//    dd($user);
//});
//
Auth::routes(['verify' => (bool) config('core.must_verify_email')]);

//Route::get('/admin', 'HomeController@index')->name('admin')->middleware(['game']);

