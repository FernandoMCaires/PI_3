<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO';
    protected $primaryKey = 'PRODUTO_ID';

    // Definindo os campos que podem ser preenchidos
    protected $fillable = ['PRODUTO_NOME', 'PRODUTO_DESC', 'PRODUTO_PRECO', 'PRODUTO_DESCONTO'];

    // Relacionamento com a categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'CATEGORIA_ID');
    }

    //Relacionamento com as imagens
    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class, 'PRODUTO_ID');
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'PRODUTO_ID');
    }
}
