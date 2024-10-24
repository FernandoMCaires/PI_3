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
        // Obtém o ID do usuário autenticado
        $userId = Auth::id();

        // Busca todos os endereços que pertencem ao usuário
        $enderecos = Endereco::where('USUARIO_ID', $userId)->get();

        // Retorna a coleção de endereços do usuário
        return response()->json(EnderecoResource::collection($enderecos), 200);
    }



    //Como estamos fazendo via api RESTFul, náo precisamos do create
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
            'USUARIO_ID' => 'required|exists:USUARIO,USUARIO_ID',
        ]);

        $endereco = Endereco::create($request->all());
        return response()->json($endereco, 201);
    }

    //Para exibir um endereco especifico
    public function show($id)
    {
        $userId = Auth::id();

        // Busca o endereço específico do usuário logado
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        // Retorna o endereço 
        return response()->json(new EnderecoResource($endereco));
    }


    public function update(Request $request, $id)
    {
        // Valida os dados recebidos
        $request->validate([
            'ENDERECO_NOME' => 'sometimes|required|string|max:255',
            'ENDERECO_LOGRADOURO' => 'sometimes|required|string|max:255',
            'ENDERECO_NUMERO' => 'sometimes|required|string|max:10',
            'ENDERECO_COMPLEMENTO' => 'sometimes|nullable|string|max:255',
            'ENDERECO_CEP' => 'sometimes|required|string|max:10',
            'ENDERECO_CIDADE' => 'sometimes|required|string|max:255',
            'ENDERECO_ESTADO' => 'sometimes|required|string|max:2',
        ]);

        // Obtém o ID do usuário autenticado
        $userId = Auth::id();

        // Busca o endereço específico do usuário
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        // Atualiza os dados do endereço
        $endereco->update($request->all());

        return response()->json(new EnderecoResource($endereco), 200);
    }



    public function destroy($id)
    {
        // Obtém o ID do usuário autenticado
        $userId = Auth::id();

        // Busca o endereço específico do usuário
        $endereco = Endereco::where('ENDERECO_ID', $id)
            ->where('USUARIO_ID', $userId)
            ->firstOrFail();

        // Remove o endereço
        $endereco->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso'], 200);
    }
}
