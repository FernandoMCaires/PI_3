<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarrinhoItem extends Model
{
    protected $table = 'CARRINHO_ITEM'; // Nome da tabela

    protected $primaryKey = 'SEU_CAMPO_CHAVE_PRIMARIA'; // Substitua por sua chave primária real

    public $incrementing = false; // Se a chave primária não for auto-incremento

    protected $keyType = 'string'; // Ajuste o tipo de chave se necessário (ex: 'int', 'string')
} 