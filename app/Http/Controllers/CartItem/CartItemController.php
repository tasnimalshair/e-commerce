<?php

namespace App\Http\Controllers\CartItem;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    use ApiResponse;

    //   public function store(StoreCategoryRequest $request)
    // {
    //     $category = Category::create($request->validated());
    //     return $this->success('Added Successfully', new CategoryResource($category), 201);
    // }
}
