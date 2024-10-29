<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials and return JWT token.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): string
    {
        $user = User::where('USUARIO_EMAIL', $this->email)->first();

        if (!$user || !Hash::check($this->password, $user->USUARIO_SENHA)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Gerar o token JWT para o usuário autenticado
        return JWTAuth::fromUser($user);
    }
}
