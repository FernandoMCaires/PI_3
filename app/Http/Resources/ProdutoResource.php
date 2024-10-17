<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $produto = [
            'id' => $this->PRODUTO_ID,
            'nome' => $this->PRODUTO_NOME,
            'desc' => $this->PRODUTO_DESC,
            'preco' => $this->PRODUTO_PRECO,
            'preco' => $this->PRODUTO_DESCONTO,
            'categoriaId' => $this->CATEGORIA_ID,
            'ativo' => $this->PRODUTO_ATIVO,
            'imagens' => [
                'img_id' => $this->IMAGEM_ID,
                'img_ordem' => $this->IMAGEM_ORDEM,
                'produto_id' => $this->PRODUTO_ID,
                'img_url' => $this->IMAGEM_URL
            ]
        ];

        return $produto;
    }
}
