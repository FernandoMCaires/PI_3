<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;


class CategoriaController extends Controller
{


    public function index()
    {
        $categorias = CategoriaResource::collection(Categoria::all());
        return response()->json($categorias);
    }
}
