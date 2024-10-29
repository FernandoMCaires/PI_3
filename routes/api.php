<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Registro de novo usuário
Route::post('/register', [RegisteredUserController::class, 'store']);
// Login de usuário
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// Logout de usuário
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:api');
// Retorna o usuário autenticado
Route::get('/user', [AuthenticatedSessionController::class, 'user'])->middleware('auth:api');

// Rotas de produtos
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

// Rotas de categorias
Route::get('/categorias', [CategoriaController::class, 'index']);

// Rotas protegidas (requere autenticação)
Route::middleware(['auth:api'])->group(function () {
    // Rotas de Endereco
    Route::apiResource('/endereco', EnderecoController::class);

    // Rotas de Carrinho e Pedidos
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionarNoCarrinho']);
    Route::get('/carrinho', [CarrinhoController::class, 'verCarrinho']);
    Route::delete('/carrinho/remover/{produtoId}', [CarrinhoController::class, 'removerDoCarrinho']);
});
