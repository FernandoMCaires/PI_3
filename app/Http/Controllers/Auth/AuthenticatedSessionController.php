<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        // Verifica se o usuário existe e se a senha está correta
        $user = User::where('USUARIO_EMAIL', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->USUARIO_SENHA)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Faz login do usuário e mantém a sessão
        Auth::login($user);

        // Se tudo estiver correto, retorna os dados do usuário
        return response()->json(['user' => $user], 200);
    }

    public function destroy(Request $request): JsonResponse
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            Auth::logout(); // Faz o logout do usuário
    
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    
        return response()->json(['message' => 'No user is logged in'], 401);
    }
    

}

