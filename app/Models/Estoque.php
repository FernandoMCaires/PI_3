<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO_ESTOQUE';
    protected $primaryKey = 'PRODUTO_ID';

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');
    }
}
