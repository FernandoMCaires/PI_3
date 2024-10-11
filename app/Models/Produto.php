<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'PRODUTO';
    protected $fillable = ['PRODUTO_NOME', 'PRODUTO_DESC', 'PRODUTO_PRECO', 'PRODUTO_DESCONTO']; 

    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'CATEGORIA_ID');
    }
}
