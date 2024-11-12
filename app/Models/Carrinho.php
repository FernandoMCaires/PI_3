<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarrinhoItem;
use Illuminate\Support\Facades\Log;

class Carrinho extends Model
{
    use HasFactory;

    protected $table = 'CARRINHO_ITEM';

    protected $primaryKey = 'USUARIO_ID';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'USUARIO_ID',
        'PRODUTO_ID',
        'ITEM_QTD',
    ];

    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');
    }

    public function adicionarItem($usuarioId, $produtoId, $quantidade)
    {
        // Verifica se o item já existe no carrinho para o usuário
        $itemExistente = CarrinhoItem::where('USUARIO_ID', $usuarioId)
                                     ->where('PRODUTO_ID', $produtoId)
                                     ->first();

        if ($itemExistente) {
            // Log antes do incremento
            Log::info("Quantidade antes do incremento: " . $itemExistente->ITEM_QTD);

            $itemExistente->ITEM_QTD += $quantidade;

            // Log após o incremento
            Log::info("Quantidade após o incremento: " . $itemExistente->ITEM_QTD);

            $itemExistente->save();
        } else {
            // Se o item não existe, cria um novo
            CarrinhoItem::create([
                'USUARIO_ID' => $usuarioId,
                'PRODUTO_ID' => $produtoId,
                'ITEM_QTD' => $quantidade, // Define a quantidade inicial
                // Adicione outros campos necessários aqui
            ]);
        }
    }

}
