<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'slug' => $this->slug,
            'product_id'     => $this->product_id,
            'size'           => $this->size,
            'color'          => $this->color,
            'price_override' => $this->price_override,
            'stock_qty'      => $this->stock_qty,
        ];
    }
}
