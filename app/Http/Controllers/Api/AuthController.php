<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // El archivo auth.php es fundamental para configurar y personalizar la lógica de autenticación de tu aplicación Larave
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Datos inválidos'
            ], 401);        
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'Sesión cerrada'
        ]);    
    }
}
