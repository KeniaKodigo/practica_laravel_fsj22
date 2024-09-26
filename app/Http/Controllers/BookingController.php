<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //metodo para actualizar el estado de la reservacion
    public function update_status(Request $request, $id){

        //validando la entrada de datos
        $validator = Validator::make($request->all(), [
            'status' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(), 
            ]);
        }

        //actualizar el estado
        $booking = Bookings::find($id); //{}
        $booking->status = $request->input('status');
        $booking->update();

        return response()->json(['message' => 'status successfully updated'], 200);
    }

    //metodo para guardar una reservacion
    public function store(Request $request){

        //validaciones de datos
        $validator = Validator::make($request->all(), [
            'booking' => 'required|string|max:10',
            'check_in_date' => 'required|date_format:Y-m-d',
            //validamos que la fecha de salida sea despues de la fecha de entrada
            'check_out_date' => 'required|date_format:Y-m-d|after:check_in_date',
            'total_amount' => 'required|numeric',
            //Validamos que los id del alojamiento y usuario existan en la base de datos
            'accomodation_id' => 'required|exists:accomodations,id',
            'user_id' => 'required|numeric|exists:users,id'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(), 
            ]);
        }

        //guardar el booking
        $booking = new Bookings();
        $booking->booking = $request->input('booking');
        $booking->check_in_date = $request->input('check_in_date');
        $booking->check_out_date = $request->input('check_out_date');
        $booking->total_amount = $request->input('total_amount');
        $booking->status = "CONFIRMED";
        $booking->accomodation_id = $request->input('accomodation_id');
        $booking->user_id = $request->input('user_id');
        $booking->save();

        return response()->json(['message' => 'Successfully registered'], 201);
    }

    //metodo para obtener todas las reservaciones
    public function get_bookings(){
        /**select bookings.*, users.name as user, accomodations.name as accomodation from bookings inner join users on bookings.user_id = users.id inner join accomodations 
        on bookings.accomodation_id = accomodations.id */
        //$bookings = Bookings::all();

        $bookings = Bookings::join('users','bookings.user_id', 'users.id')->join('accomodations','bookings.accomodation_id', 'accomodations.id')->select('bookings.*', 'users.name as user', 'accomodations.name as accomodation')->get();

        if(count($bookings) > 0){
            return response()->json($bookings, 200);
        }

        return response()->json([], 400);
    }

    //metodo para filtrar reservaciones por año
    public function get_bookings_by_year($year = null){
        //validando el parametro
        if(!$year){
            //extraemos el anio de la fecha actual
            $year = Carbon::now()->year; //2024
        }

        //consulta sql
        //select * from bookings where EXTRACT(YEAR FROM check_out_date) = 2024 (whereYear)

        $bookings = Bookings::with([
            /** mostramos con el with el objeto del usuario y el alojamiento eso hace referencia al metodo belongsTo del modelo Booking */
            'user:id,name,email,phone_number',
            'accomodation:id,name,address,description,image'
        ])->whereYear('check_out_date', $year)->get();

        if(count($bookings) > 0){
            return response()->json($bookings, 200);
        }

        return response()->json([], 400);
    }

    //metodo para mostrar reservacion con un rango de fechas por alojamiento
    public function calendar_accomodation_bookings(Request $request, $id_accomodation){

        //validando las fechas
        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //select * from bookings where accomodation_id = 24 AND check_out_date between '2024-09-01' AND '2024-11-30' 

        $query = Bookings::where('accomodation_id',$id_accomodation);
        //validando si la persona ingreso las fechas
        if($request->has('start_date') && $request->has('end_date')){
            //si la persona ingreso las fechas, agregamos en la consulta sql el rango de fechas
            $start_date = $request->input('start_date'); //2024-12-10
            $end_date = $request->input('end_date'); //2024-12-31

            $query->whereBetween('check_out_date', [$start_date, $end_date]);
        }

        $bookings = $query->get(); //[]
        return response()->json($bookings, 200);
    }
}
