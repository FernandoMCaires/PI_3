<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function finalizarPedido(Request $request)
    {
        $usuarioId = Auth::id();

        // Obtenha os itens do carrinho do usuário
        $itensCarrinho = Carrinho::where('USUARIO_ID', $usuarioId)->with('produto')->get();

        if ($itensCarrinho->isEmpty()) {
            return response()->json(['message' => 'Carrinho está vazio.'], 400);
        }

        // Calcule o total do pedido
        $totalPedido = $itensCarrinho->sum(function ($item) {
            return $item->produto->PRODUTO_PRECO * $item->ITEM_QTD;
        });

        // Crie o pedido
        $pedido = Pedido::create([
            'USUARIO_ID' => $usuarioId,
            'ENDERECO_ID' => $request->input('endereco_id'),
            'STATUS_ID' => 1,
            'PEDIDO_DATA' => now(),
        ]);

        // Crie os itens do pedido
        foreach ($itensCarrinho as $item) {
            PedidoItem::create([
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'PRODUTO_ID' => $item->PRODUTO_ID,
                'ITEM_QTD' => $item->ITEM_QTD,
                'ITEM_PRECO' => $item->produto->PRODUTO_PRECO,
            ]);
        }

        // Limpe o carrinho
        Carrinho::where('USUARIO_ID', $usuarioId)->delete();

        return response()->json(['message' => 'Pedido finalizado com sucesso.', 'pedido_id' => $pedido->PEDIDO_ID]);
    }
} 