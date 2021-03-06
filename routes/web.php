<?php

use App\Http\Controllers\EmprendedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmprendimientoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UserController;

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
Route::get('/usuario/{id}', [UserController::class, 'show'])->middleware('auth');
//Route::resource('usuario', UserController::class)->middleware('auth');
Route::get('/user/{rol}', [App\Http\Controllers\UserController::class, 'profile'])->middleware('auth');
//Auth::routes(['registrer'=>false, 'reset'=>false]);
Auth::routes();
Route::middleware('role:administrador,entidad')->group(function () {
    Route::get('/usuario/{id}/edit', [UserController::class, 'edit']);
    Route::get('/usuario', [UserController::class, 'index']);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [EmprendimientoController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    //Route::get('/', [EmprendimientoController::class, 'index'])->name('home');
    //return view('dashboard')->name('home');
    /* Route::get('/', function () {
        return view('dashboard')->name('home');
    }); */
    //Route::view('/', 'dashboard');
});

Route::get('/', function () {
    return view('official-channel');
})->middleware('auth');

Route::get('promociones', function () {
    return view('user-feed');
})->middleware('auth');

Route::get('search', function () {
    return view('search');
})->middleware('auth');

Route::get('team', function () {
    return view('emp-team');
})->middleware('role:emprendedor');

Route::get('sendemail', function () {
    return view('correo-masivo');
})->middleware('role:administrador');

Route::get('sectores', function () {
    return view('sectores');
})->middleware('role:administrador');

Route::get('actividades', function () {
    return view('actividades');
})->middleware('role:administrador');

Route::get('changepassword', function () {
    return view('change-password');
})->middleware('auth');
