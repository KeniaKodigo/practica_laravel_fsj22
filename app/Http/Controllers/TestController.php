<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    //console (backend)
    //web (frontend / backend)
    //api (backend)
}
