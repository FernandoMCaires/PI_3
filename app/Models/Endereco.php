<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $table = 'ENDERECO';
    protected $primaryKey = 'ENDERECO_ID';
    public $foreignKey = 'USUARIO_ID';
    public $timestamps = false;
    //Definindo os campos que podem ser preenchidos
    protected $fillable = [
        'ENDERECO_NOME',
        'ENDERECO_LOGRADOURO',
        'ENDERECO_NUMERO',
        'ENDERECO_COMPLEMENTO',
        'ENDERECO_CEP',
        'ENDERECO_CIDADE',
        'ENDERECO_ESTADO',
        'USUARIO_ID',
    ];
    
    public function usuario(){
        return $this->belongsTo(User::class, 'USUARIO_ID');
    }
}
