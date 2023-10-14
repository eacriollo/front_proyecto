<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Funcio para inicio de sesion recibe paramatros  
    public function funLogin(Request $request)
    {
        //validar el usuario
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // verificar que se encuentra autenticado

        if(!Auth::attempt($credenciales)){
            return response()->json(["mensaje" => "usuaro no se encuentra registrado"], 401);
        }

        // generar token para ingreso a la aplicacion

        $usuario = Auth::user();
        $token = $usuario->createToken("token personal")->plainTextToken;

        // respuesta para el acceso al sistema ya generado el token

        return response()->json([
            "access_token" => $token,
            "type_token" => "Bearer",
            "usuario" => $usuario
        ]);
    }

    public function funRegistro(Request $request)
    {
        // validar los datos ingresados
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "c_password" => "required|same:password"
        ]);

        //guardar usuario

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return response()->json(["mensaje" => "se registro el usuario"], 201);
    }

    public function funPerfil()
    {
        return Auth::user();
    }

    public function funSalir()
    {
        Auth::user()->tokens()->delete();

        return response()->json(["mensaje" => "sesion cerrada"]);
    }
}
