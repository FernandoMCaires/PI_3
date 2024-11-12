<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        // Verifica se o usuário existe e se a senha está correta
        $user = User::where('USUARIO_EMAIL', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->USUARIO_SENHA)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Gera o token JWT para o usuário
        $token = JWTAuth::fromUser($user);

        // Retorna o token junto com as informações do usuário
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function destroy(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to log out, invalid token'], 500);
        }
    }

    public function user(): JsonResponse
    {
        if (Auth::check()) {
            $usuarioId = Auth::id();
            $user = User::find($usuarioId);
        } else {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        return response()->json(['user' => $user], 200);
    }
}

