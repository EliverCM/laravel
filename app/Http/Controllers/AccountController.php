<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
public function login(Request $request)
{
    try {
        // $account = account::where('username', $request->username)->first();
        // dd($account->hash);
        // if($account){
        //     if($account->hash == $request->password){
        //         return response()->json(['data' => $account->username, 'estado' => '0']);
        //     }else{
        //         return response()->json(['data' => 'Usuario y/o contraseña incorrectos', 'estado' => '1']);
        //     }

        // }else{
        //         return response()->json(['data' => 'Usuario no existe', 'estado' => '1']);
        // }

            $credentials = $request->only('username', 'password');
            $account = account::where('username', $credentials['username'])->first();

            if (!$account) {
                return response()->json(['data' => 'Usuario no existe', 'estado' => '1']);
            }

            if ($account->hash === $credentials['password']) {
                // Las credenciales son válidas, generar un token JWT
                $token = Auth::guard('api')->login($account);

                // Devolver el token JWT en la respuesta
                return response()->json(['token' => $token, 'estado' => '0']);
            } else {
                return response()->json(['data' => 'Usuario y/o contraseña incorrectos', 'estado' => '1']);
            }

        // Si llegamos aquí, la consulta se ejecutó con éxito
    } catch (\Exception $e) {
        // Captura cualquier excepción genérica que pueda ocurrir
        return response()->json(['mensaje' => $e->getMessage(), 'estado' => '1'], 500);
    }
}
}
