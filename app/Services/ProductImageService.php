<?php

namespace App\Services;

use App\Models\Product;


class ProductImageService
{
    public function upload(Product $product, $images): void
    {
        if (!$images) {
            return;
        }

        if (!is_array($images)) {
            $product->addMedia($images)
                ->toMediaCollection('products');
        } else {
            foreach ($images as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('products');
            }
        }
    }
}
