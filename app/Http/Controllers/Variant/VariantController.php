<?php

namespace App\Http\Controllers\Variant;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\StoreVariantRequest;
use App\Http\Requests\Variant\UpdateVariantRequest;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $variants = Variant::all();
        return $this->success('Retrieved Successfully', VariantResource::collection($variants), 200);
    }

    public function show(Variant $variant)
    {
        return $this->success('Retrieved Successfully', new VariantResource($variant), 200);
    }

    public function store(StoreVariantRequest $request)
    {
        $variant = Variant::create($request->validated());
        return $this->success('Added Successfully', new VariantResource($variant), 201);
    }

    public function update(UpdateVariantRequest $request, Variant $variant)
    {
        $variant->update($request->validated());
        return $this->successMessage('Updated Successfully', 200);
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();
        return $this->successMessage('Deleted Successfully', 200);
    }
}
