<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //crear un monton de funciones
    function saludar(){
        echo "Hola! Te saludo desde el controller";
    }

    function despedir(){
        echo "Adios! con laravel y rutas";
    }

    //retornando una vista
    function getVista(){
        return view('test');
    }

    function getUsers(){
        //select * from users
        $users = User::all(); //[]
        
        return response()->json($users);
    }

    public function testBookingsQuery(){
        //select * from bookings
        //query builder
        //$booking = DB::table('bookings')->get();

        //modelos (ORM)
        //consultas mapeadas
        //manera indirecta a la base de datos
        //$booking = Bookings::all(); //select * from table

        //select booking, total_amount from bookings
        //$booking = DB::table('bookings')->select('booking', 'total_amount')->get();

        //select * from bookings where id = 4
        //$booking = DB::table('bookings')->where('id', '=', 4)->get();

        //$booking = Bookings::find(4); //solo encuentra id

        //select * from bookings where total_amount >= 100
        //$booking = Bookings::where('total_amount', '>=', 100)->get();
        //select * from bookings order by user_id desc
        $booking = Bookings::orderBy('user_id', 'desc')->get();

        //save() guardar un registro
        //update() actualizar un registro
        //delete() eliminar un registro

        //DB::table('users')->where('name', 'John')->first();

        //return json_encode($booking);
        return response()->json($booking);
    }

    //console (backend)
    //web (frontend / backend)
    //api (backend)
}
