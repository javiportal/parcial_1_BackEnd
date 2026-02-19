<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
        public function toArray(Request $request): array
    {
        return [
            'titulo'=> $this->titulo,
            'descripcion'=> $this->descripcion,
            'ISBN'=> $this->isbn,
            'copias_totales'=> $this->copias_totales,
            'copias_disponibles'=> $this->copias_disponibles,
            'estado'=> $this->estado,
        ];
    }
}