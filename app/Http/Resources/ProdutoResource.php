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
            'desconto' => $this->PRODUTO_DESCONTO,
            'categoriaId' => $this->CATEGORIA_ID,
            'ativo' => $this->PRODUTO_ATIVO,
            'imagens' => $this->imagens->map(function($imagem) {
                return [
                    'img_id' => $imagem->IMAGEM_ID,
                    'img_ordem' => $imagem->IMAGEM_ORDEM,
                    'produto_id' => $imagem->PRODUTO_ID,
                    'img_url' => $imagem->IMAGEM_URL
                ];
            }),
        ];

        return $produto;
    }
}
