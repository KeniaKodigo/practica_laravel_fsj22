<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $passowrd = $request->input('passowrd');

        //tengo que validar que el correo y la password existan en la base de datos
        //select * from users where email = $email and password...
        $user = User::where('email',$email)->where('password',$passowrd)->first(); //{}

        //si el usuario existe en la bd, creamos su token
        if($user){
            //generar un token
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                "user" => $email,
                "token" => $token
            ], 200);
        }else{
            return response()->json(["message" => "You are not authorized"], 401);
        }
    }
}
