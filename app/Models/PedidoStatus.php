<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoStatus extends Model
{
    use HasFactory;

    protected $table = 'PEDIDO_STATUS';
    public $timestamps = false;
    protected $fillable = [
        'STATUS_ID',
        'PEDIDO_DESC'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'STATUS_ID', 'STATUS_ID');
    }
}
