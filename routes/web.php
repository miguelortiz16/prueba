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


Route::get('/Owners','App\Http\Controllers\OwnersController@index');

Route::post('/Owners','App\Http\Controllers\OwnersController@store');
Route::post('/Owners/update','App\Http\Controllers\OwnersController@update');

Route::post('/Owners/dalete','App\Http\Controllers\OwnersController@delete');
Route::post('/Owners/disapprove','App\Http\Controllers\OwnersController@disapprove');
Route::post('/Owners/approve','App\Http\Controllers\OwnersController@Approve');



Route::get('/Cars','App\Http\Controllers\CarsController@index');
Route::post('/listOption','App\Http\Controllers\CarsController@listOption');
Route::get('/listBrand','App\Http\Controllers\CarsController@listBrand');
Route::post('/Cars','App\Http\Controllers\CarsController@store');
Route::post('/Cars/update','App\Http\Controllers\CarsController@update');

Route::post('/Cars/dalete','App\Http\Controllers\CarsController@delete');
Route::post('/Cars/disapprove','App\Http\Controllers\CarsController@disapprove');
Route::post('/Cars/approve','App\Http\Controllers\CarsController@Approve');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
