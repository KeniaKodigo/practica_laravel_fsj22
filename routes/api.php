<?php

use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\BookingController;
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
//guardando un alojamiento
Route::post('/V1/accomodation', [AccomodationsController::class, 'store']);
//actualizando un alojamiento
Route::put('/V1/accomodation/{id}', [AccomodationsController::class, 'update']);

//Rutas de reservaciones
Route::patch('/V1/status_booking/{id}', [BookingController::class, 'update_status']);

Route::post('/V1/booking', [BookingController::class, 'store']);
