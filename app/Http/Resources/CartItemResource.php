<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cart' => [
                'id' => $this->cart->id,
                'user_id' => $this->cart->user_id,
                'product' => [
                    'id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                ],
                'quantity' => $this->quantity,
                'total' => $this->quantity * $this->product->price,

            ]
        ];
    }
}
