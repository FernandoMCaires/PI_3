<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Produto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CarrinhoController extends Controller
{
    //Adiciona um produto no carrinho do cliente
    public function adicionarNoCarrinho(Request $request)
    {
        $produtoId = $request->input('PRODUTO_ID');
        $quantidade = $request->input('ITEM_QTD', 1);


        //Verifica a existencia e disponibilidade pela quantidade do produto
        $produto = Produto::find($produtoId);
        if (!$produto || $produto->stock < $quantidade) {
            return response()->json(['Aviso:' => 'Esse produto não tem a quantidade disponivel', 404]);
        }

        //adiciona ou atualiza o produto que está no carrinho
        $itemCarrinho = Carrinho::updateOrCreate(
            [
                'USUARIO_ID' => session()->getId(), // Usa sempre o ID da sessão -> isso é uma medida temporária até a gente arrumar como fazer autentificação
                'PRODUTO_ID'=>$produtoId
            ],

            [
                'ITEM_QTD'=>$quantidade
            ]
        );
        return response()->json(['mensagem'=>'Produto adicionado ao carrinho!', 'carrinho'=>$itemCarrinho]);
    }


    //Exibe os itens no carrinho

    public function verCarrinho(){
        $itemCarrinho = Carrinho::where('USUARIO_ID', session()->getId())->with('PRODUTO_ID')->get(); 


        $totalCarrinho = $itemCarrinho->sum(function($item){
            return $item->produto->PRODUTO_PRECO * $item->ITEM_QTD;
        });

        return response()->json(['itens:'=> $itemCarrinho, 'total'=>$totalCarrinho]);
    }


    //Remover do carrinho:
    public function removerDoCarrinho($produtoId){
        $itemCarrinho = Carrinho::where('USUARIO_ID', session()->getId())->where('PRODUTO_ID', $produtoId)->first();

        if($itemCarrinho){
            $itemCarrinho->delete();
            return response()->json(['mensagem:'=>'Produto removido do carrinho']);
        }
        return response()->json(['mensagem:'=>'Produto nao encontrado no carrinho'], 404);
    }
}
