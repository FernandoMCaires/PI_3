<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = 'PRODUTO';
    
    public function category()
    {
        return $this->belongsTo(Categoria::class, 'CATEGORIA_ID');
    }
}
