<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function funIngresar(Request $request){
        
        $credenciales = $request->validate([
        "email"     => "required|email",
        "password"  => "required",
        ]);
    
        if(!Auth::attempt($credenciales)){
            return  response()->json(["message" => "credenciales incorrectas"],401);
        }
       // $usuario= Auth::user();
        // $usuario= request()->user();
       $usuario= $request->user();
       $token =$usuario->createToken("Tokenpersona")->plainTextToken;
       
        return response()->json([
            "access_token" =>$token,
            "usuario" => $credenciales
        ],201);

    
    }
    public function funlRegistro(Request $request){
          // validar (Accept: application/json) 302
          $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);
        // guardar
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // respuesta
        return response()->json(["message" => "Usuario registrado", "data"=> $user], 201);
    }
    public function funlPerfil(Request $request){
        return  response()->json($request->user(), 200);
    }
    public function funlSalir(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["message"=>"salio"],200);
    }
}
