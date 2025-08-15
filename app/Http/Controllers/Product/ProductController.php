<?php

namespace App\Http\Controllers\Product;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::with(['category', 'seller'])->get();
        return $this->success('Retrieved Successfully', ProductResource::collection($products), 200);
    }

    public function show(Product $product)
    {
        return $this->success('Retrieved Successfully', new ProductResource($product), 200);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['seller_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . time() . '_' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('products', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $product = Product::create($data);
        return $this->success('Added Successfully', new ProductResource($product), 201);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $this->successMessage('Updated Successfully', 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successMessage('Deleted Successfully', 200);
    }
}
