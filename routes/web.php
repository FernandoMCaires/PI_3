<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});



