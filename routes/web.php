<?php

use App\Http\Controllers\EmprendedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmprendimientoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\FuncionarioController;

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
    return view('auth.login');
});

/* Route::get('/emprendimiento', function () {
    return view('emplead.index');
});

Route::get('/emprendimiento/create', [EmprendimientoController::class,'create']); */

Route::resource('emprendimiento', EmprendimientoController::class)->middleware('auth');
Route::resource('emprendedor', EmprendedorController::class)->middleware('auth');
Route::resource('entidad', EntidadController::class)->middleware('auth');
Route::resource('funcionario', FuncionarioController::class)->middleware('auth');
//Auth::routes(['registrer'=>false, 'reset'=>false]);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [EmprendimientoController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmprendimientoController::class, 'index'])->name('home');
});
