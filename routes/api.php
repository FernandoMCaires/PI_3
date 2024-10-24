<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EnderecoController;

// Rotas de autenticação
require __DIR__ . '/auth.php';

// Rotas abertas (públicas)

// Rotas de produtos
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

// Rotas de categorias
Route::get('/categorias', [CategoriaController::class, 'index']);

// Rotas protegidas (requere autenticação)
Route::middleware(['auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Rotas de Endereco
    Route::apiResource('/endereco', EnderecoController::class);

    // Rotas de Carrinho e Pedidos
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionarNoCarrinho']);
    Route::get('/carrinho', [CarrinhoController::class, 'verCarrinho']);
    Route::delete('/carrinho/remover/{produtoId}', [CarrinhoController::class, 'removerDoCarrinho']);
});
