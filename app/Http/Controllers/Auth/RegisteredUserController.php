<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $cpf = preg_replace('/\D/', '', $request->cpf);

        $user = User::create([
            'USUARIO_NOME' => $request->name,
            'USUARIO_EMAIL' => $request->email,
            'USUARIO_CPF' => $cpf,
            'USUARIO_SENHA' => Hash::make($request->input('password'))
        ]);

        event(new Registered($user));

        // Gerar o token JWT para o usuário registrado
        $token = JWTAuth::fromUser($user);

        // Retorne o usuário e o token como JSON
        return response()->json(['user' => $user, 'token' => $token], 201);
    }
}
