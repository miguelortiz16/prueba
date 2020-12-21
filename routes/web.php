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
//pet router
Route::post('/pet/findByStatus','App\Http\Controllers\PetsController@index');

Route::post('/pet','App\Http\Controllers\PetsController@store');
Route::put('/petss','App\Http\Controllers\PetsController@update');

Route::post('/deletepet','App\Http\Controllers\PetsController@delete');



//category router
Route::get('/category','App\Http\Controllers\PetsController@lisCategory');
Route::get('/Tags','App\Http\Controllers\PetsController@listTags');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
