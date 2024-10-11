<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Carrinho extends Model
{
    use HasFactory;

    protected $table = 'CARRINHO_ITEM';

    protected $fillable = [
        'USUARIO_ID',
        'PRODUTO_ID',
        'ITEM_QTD'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
