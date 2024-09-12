<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //crear un monton de funciones
    function saludar(){
        echo "Hola! Te saludo desde el controller";
    }

    function despedir(){
        echo "Adios!";
    }

    //retornando una vista
    function getVista(){
        return view('test');
    }
}
