<?php

namespace App\Http\Controllers\Category;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::all();
        return $this->success('Retrieved Successfully', CategoryResource::collection($categories), 200);
    }

    public function show(Category $category)
    {
        return $this->success('Retrieved Successfully', new CategoryResource($category), 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->success('Added Successfully', new CategoryResource($category), 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->successMessage('Updated Successfully', 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successMessage('Deleted Successfully', 200);
    }
}
