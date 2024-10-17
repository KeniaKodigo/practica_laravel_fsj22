<?php
//namespace

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
//node_modules
Route::get('/', function () {
    return view('welcome');
});

//creando otra vista
// Route::get('/bienvenida', function () {
//     return view('welcome');
// });

//Ruta que se utiliza para ejecutar una funcion desde un controlador
Route::get('/mensaje', [TestController::class, 'saludar']);

Route::get('/test', [TestController::class, 'getVista']);
/**
 * peticiones http: get, post, put, delete, patch
 */
Route::get('/despedida', [TestController::class, 'despedir']);

Route::get('/usuarios', [TestController::class, 'getUsers']);

// Route::get('/bookings', [TestController::class, 'testBookingsQuery']);

/**
 * web => manejamos proyectos tanto frontend y backend
 * api => manejamos la parte backend
 * console => manejamos un proyecto en consola
 */
/**aqui comento Isaac */