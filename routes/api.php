<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Rotas abertas (públicas)
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);
Route::get('/categorias', [CategoriaController::class, 'index']);

// Rotas protegidas (requere autenticação)
Route::middleware(['auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Rotas de Carrinho e Pedidos aqui
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionarNoCarrinho']);
    Route::get('/carrinho', [CarrinhoController::class, 'verCarrinho']);
    Route::delete('/carrinho/remover/{produtoId}', [CarrinhoController::class, 'removerDoCarrinho']);
});
