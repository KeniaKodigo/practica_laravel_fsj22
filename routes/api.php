<?php

use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rutas de alojamientos
Route::get('/V1/accomodations', [AccomodationsController::class, 'getAccomodations']);
//creando una ruta con parametro {}
Route::get('/V1/accomodation_by_id/{id}', [AccomodationsController::class, 'get_accomodation_by_id']);

Route::post('/V1/accomodation', [AccomodationsController::class, 'store']);