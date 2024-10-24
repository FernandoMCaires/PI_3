<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $endereco = [
        'id' => $this->ENDERECO_ID,
        'enderecoNome' => $this->ENDERECO_NOME,
        'logradouro' => $this->ENDERECO_LOGRADOURO,
        'numero' => $this->ENDERECO_NUMERO,
        'complemento' => $this->ENDERECO_COMPLEMENTO,
        'cep' => $this->ENDERECO_CEP,
        'cidade' => $this->ENDERECO_CIDADE,
        'estado' => $this->ENDERECO_ESTADO,
        ];

        return $endereco;
    }
}
