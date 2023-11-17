<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrar',[RegisterController::class,'show']);

Route::post('/registrar',[RegisterController::class,'register']);

Route::get('/ingresar',[LoginController::class,'show']);

Route::post('/ingresar',[LoginController::class,'login']);

Route::get('/inicio',[HomeController::class,'show']);

Route::get('/logout',[LogoutController::class,'logout']);