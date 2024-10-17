<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $categoria = [
            'id' => $this->CATEGORIA_ID,
            'nome' => $this->CATEGORIA_NOME,
            'desc' => $this->CATEGORIA_DESC,
            'ativo' => $this->CATEGORIA_ATIVO,
        ];

        return $categoria;
    }
}
