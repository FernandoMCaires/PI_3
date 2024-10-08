<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
       $categorias = Categoria::all();
       return Inertia::render('Categorias/index', ['categorias' => $categorias]);
    }
}
