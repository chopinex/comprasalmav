<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\CompraController;

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

Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);
 
Route::get('/auth/{provider}/callback', [ProviderController::class,'callback']);

Route::resource('projects',ProjectController::class);

Route::resource('compras',CompraController::class);

Route::get('/obtener-opciones/{selectedValue}', [CompraController::class,'getOptions']);