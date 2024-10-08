<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;


use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);




require __DIR__.'/auth.php';
