<?php

namespace App\Http\Controllers;

use App\Models\Accomodations;
use Illuminate\Http\Request;

class AccomodationsController extends Controller
{
    //metodo para obtener todos los alojamientos
    public function getAccomodations(){

        //select * from accomodations
        $accomodations = Accomodations::all(); //[]

        if(count($accomodations) > 0){
            //mandamos los registros con status 200 (OK)
            return response()->json($accomodations, 200);
        }

        //No hay data
        return response()->json(['message' => 'No accomodations at the moment'], 400);
    }

    //metodo para buscar un alojamiento
    public function get_accomodation_by_id($id){
        //select * from accomodations where id = ?
        $accomodation = Accomodations::find($id); // {} / null

        if($accomodation != null){
            return response()->json($accomodation, 200);
        }

        return response()->json(['message' => 'Accomodation not found'], 400);
    }

    //metodo para registrar un alojamiento
    public function store(Request $request){

        //guardando un alojamiento (INSERT INTO....)
        //tarea = new Tarea();
        $accomodation = new Accomodations();
        $accomodation->name = $request->input('name');
        $accomodation->address = $request->input('address');
        $accomodation->description = $request->input('description');
        $accomodation->image = $request->input('image');
        $accomodation->save();

        return response()->json(['message' => 'Successfully registered'], 201);
    }
}
