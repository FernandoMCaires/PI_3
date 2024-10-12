<?php

namespace App\Models;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    use HasFactory;

   protected $table = 'PRODUTO_IMAGEM';
   protected $primaryKey = 'IMAGEM_ID';      
   public function produto(){
    return $this->belongsTo(Produto::class, 'PRODUTO_ID');
   }
}
