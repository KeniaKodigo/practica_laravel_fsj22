<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
//node_modules
Route::get('/', function () {
    return view('test');
});

//creando otra vista
Route::get('/bienvenida', function () {
    return view('welcome');
});

//Ruta que se utiliza para ejecutar una funcion desde un controlador
Route::get('/mensaje', [TestController::class, 'saludar']);

Route::get('/test', [TestController::class, 'getVista']);

/**
 * web => manejamos proyectos tanto frontend y backend
 * api => manejamos la parte backend
 * console => manejamos un proyecto en consola
 */