<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\AdminController;


route::get('/',[AdminController::class ,'intranet'])->name('intranet')->middleware('validarToken');

route::get('iniciar-sesion',[loginController::class ,'login'])->name('login');
route::get('cerrar-sesion',[loginController::class ,'cerrarSesion'])->name('cerrarSesion')->middleware('validarToken');
Route::get('forgot-password', [loginController::class, 'forgotPassword'])->name('password.request');
Route::get('reset-password/{token}', [loginController::class, 'resetPassword'])->name('password.reset');
