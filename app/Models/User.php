<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'USUARIO';
    protected $primaryKey = 'USUARIO_ID';
    public $timestamps = false;

    protected $fillable = [
        'USUARIO_NOME',
        'USUARIO_EMAIL',
        'USUARIO_SENHA',
        'USUARIO_CPF'
    ];

    protected $hidden = [
        'USUARIO_SENHA',
    ];

    public function getAuthPassword()
    {
        return $this->USUARIO_SENHA;
    }

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'USUARIO_ID');
    }

    // Implementa o método getJWTIdentifier
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Retorna o ID do usuário
    }

    // Implementa o método getJWTCustomClaims
    public function getJWTCustomClaims()
    {
        return []; // Retorna um array de dados personalizados, se necessário
    }

    public function pedidosStatus()
    {
        return $this->hasMany(PedidoStatus::class, 'PRODUTO_ID');
    }

}
