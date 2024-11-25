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
            'nome' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:10',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
        ]);

        $endereco = Endereco::create([
            'USUARIO_ID' => $userId,
            'ENDERECO_NOME' => $request->input('logradouro'),
            'ENDERECO_LOGRADOURO' => $request->input('logradouro'),
            'ENDERECO_NUMERO' => $request->input('numero'),
            'ENDERECO_COMPLEMENTO' => $request->input('complemento'),
            'ENDERECO_CEP' => $request->input('cep'),
            'ENDERECO_CIDADE' => $request->input('cidade'),
            'ENDERECO_ESTADO' => $request->input('estado'),
        ]);

        return response()->json(['message' => 'Endereço adicionado com sucesso' , "endereco" => new EnderecoResource($endereco)], 201);
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
            'nome' => 'sometimes|required|string|max:255',
            'logradouro' => 'sometimes|required|string|max:255',
            'numero' => 'sometimes|required|string|max:10',
            'complemento' => 'sometimes|nullable|string|max:255',
            'cep' => 'sometimes|required|string|max:10',
            'cidade' => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|max:2',
        ]);

        $userId = Auth::id();
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        $endereco->update([
            'ENDERECO_NOME' => $request->input('nome', $endereco->ENDERECO_NOME),
            'ENDERECO_LOGRADOURO' => $request->input('logradouro', $endereco->ENDERECO_LOGRADOURO),
            'ENDERECO_NUMERO' => $request->input('numero', $endereco->ENDERECO_NUMERO),
            'ENDERECO_COMPLEMENTO' => $request->input('complemento', $endereco->ENDERECO_COMPLEMENTO),
            'ENDERECO_CEP' => $request->input('cep', $endereco->ENDERECO_CEP),
            'ENDERECO_CIDADE' => $request->input('cidade', $endereco->ENDERECO_CIDADE),
            'ENDERECO_ESTADO' => $request->input('estado', $endereco->ENDERECO_ESTADO),
        ]);

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
