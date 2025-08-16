<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'price'       => $this->price,
            'images'       => $this->getMedia('products')->map(function ($media) {
                return $media->getUrl();
            }),
            'stock'       => $this->stock,
            'category'    => new CategoryResource($this->whenLoaded('category')),
            'seller'    => new UserResource($this->whenLoaded('seller')),
        ];
    }
}
