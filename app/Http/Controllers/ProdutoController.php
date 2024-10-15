<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    public function index(): JsonResponse
    {
        // Retorna todos os produtos
        $produtos = Produto::with('imagens')->get();
        return response()->json($produtos);
    }

    public function show($id): JsonResponse
    {
        // Busca um produto pelo ID junto da sua imagem já
        $produto = Produto::with('imagens')->find($id);

        if ($produto) {
            return response()->json($produto);
        }

        return response()->json(['Aviso:' => 'Produto não encontrado'], 404);
    }

    public function getProdutosPorCategoria($categoriaId): JsonResponse
    {
        //Basicamente na model de Produto, ele procura CATEGORIA_ID e atribui nessa variavel $categoriaId e retorna Produtos por Categoria
        $produtos = Produto::with('imagens')
        ->where('CATEGORIA_ID', $categoriaId)
        ->get();
        return response()->json($produtos);
    }
}
