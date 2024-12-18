<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    // Método para adicionar um produto ao carrinho ou atualizar a quantidade


    // Exibe os itens no carrinho
    public function verCarrinho()
    {
        // Use o ID do usuário autenticado
        $usuarioId = Auth::id();

        $itensCarrinho = Carrinho::where('USUARIO_ID', $usuarioId)->with('produto')->get();

        $totalCarrinho = $itensCarrinho->sum(function ($item) {
            return $item->produto->PRODUTO_PRECO * $item->ITEM_QTD;
        });

        return response()->json(['itens' => $itensCarrinho, 'total' => $totalCarrinho]);
    }

    // Cria um pedido a partir do carrinho e limpa o carrinho
    public function criarPedido(Request $request)
    {
        $usuarioId = session()->getId();
        $itensCarrinho = Carrinho::where('USUARIO_ID', $usuarioId)->get();

        if ($itensCarrinho->isEmpty()) {
            return response()->json(['mensagem' => 'Carrinho está vazio'], 404);
        }

        // Cria um novo pedido
        $pedido = Pedido::create([
            'USUARIO_ID' => $usuarioId,
            'ENDERECO_ID' => $request->input('ENDERECO_ID'),
            'STATUS_ID' => 1,
            'PEDIDO_DATA' => now(),
        ]);

        // Adiciona os itens do carrinho ao pedido
        foreach ($itensCarrinho as $item) {
            PedidoItem::create([
                'PRODUTO_ID' => $item->PRODUTO_ID,
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'ITEM_QTD' => $item->ITEM_QTD,
                'ITEM_PRECO' => $item->produto->PRODUTO_PRECO,
            ]);
        }

        // Limpa o carrinho
        Carrinho::where('USUARIO_ID', $usuarioId)->delete();

        return response()->json(['mensagem' => 'Pedido criado com sucesso!', 'pedido' => $pedido]);
    }

  
    public function atualizaCarrinho(Request $request)
    {
        $produtoId = $request->input('PRODUTO_ID');
        $quantidade = $request->input('ITEM_QTD');

        // Verifica a existência e disponibilidade pela quantidade do produto no estoque
        $produtoEstoque = DB::table('PRODUTO_ESTOQUE')->where('PRODUTO_ID', $produtoId)->first();

        if (!$produtoEstoque || $produtoEstoque->PRODUTO_QTD < $quantidade) {
            return response()->json(['Aviso' => 'Esse produto não tem a quantidade disponível'], 404);
        }

        // Use o ID do usuário autenticado
        $usuarioId = Auth::id();

        // Verifica se o produto já está no carrinho
        $itemCarrinho = Carrinho::where('USUARIO_ID', $usuarioId)
            ->where('PRODUTO_ID', $produtoId)
            ->first();

        if ($itemCarrinho) {
            Carrinho::where('PRODUTO_ID', $produtoId)
                ->where('USUARIO_ID', $usuarioId)
                ->update(['ITEM_QTD' => $quantidade]);

            if ($quantidade == 0) {
                Carrinho::where('PRODUTO_ID', $produtoId)
                    ->where('USUARIO_ID', $usuarioId)
                    ->delete();

                return response()->json(['mensagem' => 'Produto removido do carrinho com sucesso!']);
            }

            return response()->json(['mensagem' => 'Quantidade atualizada com sucesso!']);
        } else {
            // Adiciona um novo item ao carrinho
            $itemCarrinho = Carrinho::create([
                'USUARIO_ID' => $usuarioId,
                'PRODUTO_ID' => $produtoId,
                'ITEM_QTD' => $quantidade,
            ]);
        }

        return response()->json(['mensagem' => 'Produto adicionado ao carrinho!', 'carrinho' => $itemCarrinho]);
    }
    
      // Remove um produto do carrinho
      public function removerDoCarrinho($produtoId)
      {
          $usuarioId = Auth::id();
  
          $itemCarrinho = Carrinho::where('USUARIO_ID', $usuarioId)
              ->where('PRODUTO_ID', $produtoId)
              ->first();
  
          if ($itemCarrinho) {
              Carrinho::where('PRODUTO_ID', $produtoId)
                  ->where('USUARIO_ID', $usuarioId)
                  ->delete();
  
              return response()->json(['mensagem' => 'Produto removido do carrinho com sucesso!']);
          }
  
          return response()->json(['mensagem' => 'Produto não encontrado no carrinho'], 404);
      }
}
