<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;

//Usuario - cadastro cliente


// Produtos
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show']);
Route::get('/produtos/categoria/{categoriaId}', [ProdutoController::class, 'getProdutosPorCategoria']); // Rota para obter produtos por categoria

// Categorias
Route::get('/categorias', [CategoriaController::class, 'index']);//Rota para listar as categorias

// Carrinho -> esta sendo testado ainda
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionarNoCarrinho']); // Rota para adicionar produto no carrinho
Route::get('/carrinho', [CarrinhoController::class, 'verCarrinho']); // Rota para ver itens no carrinho
Route::delete('/carrinho/remover/{produtoId}', [CarrinhoController::class, 'removerDoCarrinho']); // Rota para remover produto do carrinho

//Cadastro Endereço

//Pedido -> Aqui são os dados do pedido 

//Pedido Item -> Aqui vem os pedidos, no caso, chama os produtos, quantidades e preços, e o preço total

//Pedido Status

