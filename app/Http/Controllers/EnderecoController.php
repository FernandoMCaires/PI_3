<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnderecoResource;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $enderecos = Endereco::where('USUARIO_ID', $userId)->get();
        return response()->json(EnderecoResource::collection($enderecos), 200);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            'ENDERECO_NOME' => 'required|string|max:255',
            'ENDERECO_LOGRADOURO' => 'required|string|max:255',
            'ENDERECO_NUMERO' => 'required|string|max:10',
            'ENDERECO_COMPLEMENTO' => 'nullable|string|max:255',
            'ENDERECO_CEP' => 'required|string|max:10',
            'ENDERECO_CIDADE' => 'required|string|max:255',
            'ENDERECO_ESTADO' => 'required|string|max:2',
        ]);

        $endereco = Endereco::create([
            'USUARIO_ID' => $userId,
            'ENDERECO_NOME' => $request->input('ENDERECO_NOME'),
            'ENDERECO_LOGRADOURO' => $request->input('ENDERECO_LOGRADOURO'),
            'ENDERECO_NUMERO' => $request->input('ENDERECO_NUMERO'),
            'ENDERECO_COMPLEMENTO' => $request->input('ENDERECO_COMPLEMENTO'),
            'ENDERECO_CEP' => $request->input('ENDERECO_CEP'),
            'ENDERECO_CIDADE' => $request->input('ENDERECO_CIDADE'),
            'ENDERECO_ESTADO' => $request->input('ENDERECO_ESTADO'),
        ]);

        return response()->json(new EnderecoResource($endereco), 201);
    }

    public function show($id)
    {
        $userId = Auth::id();
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        return response()->json(new EnderecoResource($endereco));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ENDERECO_NOME' => 'sometimes|required|string|max:255',
            'ENDERECO_LOGRADOURO' => 'sometimes|required|string|max:255',
            'ENDERECO_NUMERO' => 'sometimes|required|string|max:10',
            'ENDERECO_COMPLEMENTO' => 'sometimes|nullable|string|max:255',
            'ENDERECO_CEP' => 'sometimes|required|string|max:10',
            'ENDERECO_CIDADE' => 'sometimes|required|string|max:255',
            'ENDERECO_ESTADO' => 'sometimes|required|string|max:2',
        ]);

        $userId = Auth::id();
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        $endereco->update($request->all());

        return response()->json(new EnderecoResource($endereco), 200);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        $endereco->delete();

        return response()->json(['message' => 'Endereço excluido com sucesso'], 200);
    }
}
