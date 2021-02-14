<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/users','App\Http\Controllers\UsersController@index');

Route::post('/users','App\Http\Controllers\UsersController@store');
Route::put('/users','App\Http\Controllers\UsersController@update');

Route::post('/users','App\Http\Controllers\UsersController@delete');




Route::get('/telecommuting','App\Http\Controllers\TelecommutingController@index');

Route::post('/telecommuting','App\Http\Controllers\TelecommutingController@store');
Route::put('/telecommuting','App\Http\Controllers\TelecommutingController@update');

Route::post('/telecommuting','App\Http\Controllers\TelecommutingController@delete');




Route::get('/applications','App\Http\Controllers\ApplicationsController@index');

Route::post('/applications','App\Http\Controllers\ApplicationsController@store');
Route::post('/applications/update','App\Http\Controllers\ApplicationsController@update');

Route::post('/applications/dalete','App\Http\Controllers\ApplicationsController@delete');
Route::post('/applications/disapprove','App\Http\Controllers\ApplicationsController@disapprove');
Route::post('/applications/approve','App\Http\Controllers\ApplicationsController@Approve');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
