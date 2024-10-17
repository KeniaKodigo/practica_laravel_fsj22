<?php

use App\Http\Controllers\AccomodationsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\bookingsApiToken;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Ruta protegidas por medio de sanctum (agrupar) (tokens)
// Route::middleware('auth:sanctum')->group(function() {
//     Route::get('/V1/bookings', [BookingController::class, 'get_bookings']);
//     //declaramos una ruta con un parametro opcional (?)
//     Route::get('/V1/bookings_by_year/{year?}', [BookingController::class, 'get_bookings_by_year']);
//     Route::get('/V1/bookings/calendar/{id_accomodation}', [BookingController::class, 'calendar_accomodation_bookings']);
// });

//Crear un middleware personalizado para proteger rutas (API-KEY) 
Route::middleware(bookingsApiToken::class)->group(function() {
    Route::get('/V1/accomodations', [AccomodationsController::class, 'getAccomodations']);
    //creando una ruta con parametro {}
    Route::get('/V1/accomodation_by_id/{id}', [AccomodationsController::class, 'get_accomodation_by_id']);
});

//Rutas de alojamientos
//guardando un alojamiento
Route::post('/V1/accomodation', [AccomodationsController::class, 'store']);
//actualizando un alojamiento
Route::put('/V1/accomodation/{id}', [AccomodationsController::class, 'update']);

//Rutas de reservaciones
Route::patch('/V1/status_booking/{id}', [BookingController::class, 'update_status']);

Route::post('/V1/booking', [BookingController::class, 'store']);

//Ruta con autorizacion basica
Route::get('/V1/bookings_by_user', [BookingController::class, 'get_bookings_by_user']);

//Ruta para el login
Route::post('/V1/login', [LoginController::class, 'login']);