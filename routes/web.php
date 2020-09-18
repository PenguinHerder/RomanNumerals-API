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
    return view('welcome');
});

Route::get('convert/{number}', 'RomanController@convert')->where('number', '[0-9]+');
Route::get('convert/recent', 'RomanController@recent');
Route::get('convert/top', 'RomanController@top');
		