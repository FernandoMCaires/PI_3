<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisteredUserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $cpf = preg_replace('/\D/', '', $request->cpf);

        $user = User::create([
            'USUARIO_NOME' => $request->input('name'),
            'USUARIO_EMAIL' => $request->input('email'),
            'USUARIO_CPF' => $cpf,
            'USUARIO_SENHA' => Hash::make($request->input('password'))
        ]);

        event(new Registered($user));

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

}
