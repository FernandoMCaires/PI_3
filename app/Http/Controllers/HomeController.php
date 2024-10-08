<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        
        return Inertia::render('Home/index', [
            'categorias' => $categorias,
        ]);
    }

    
}

