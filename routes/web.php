<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\DashboardController::class,'index']);


Route::get('/LoadLineChart',[App\Http\Controllers\DashboardController::class,'LoadLineChart']);
Route::get('/updateBoard',[App\Http\Controllers\DashboardController::class,'updateBoard']);
Route::get('/devices/{id}',[App\Http\Controllers\DashboardController::class,'getDeviceInfo']);
Route::get('/download/{id}',[App\Http\Controllers\DashboardController::class,'downloadFile']);
Route::get('/resetMeter',[App\Http\Controllers\DashboardController::class,'resetEnergyMeter']);
Route::get('/resetLimit',[App\Http\Controllers\DashboardController::class,'resetLimitStatus']);   