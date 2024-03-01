<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
        
        
        public function index(): JsonResource
        {                
                $categories = Category::get();
            
                return CategoryResource::collection($categories);
        }


        public function store (CategoryRequest $request)
        {
            $category = Category::create($request->all());
        
            return new CategoryResource($category);
        }


        public function show($category)
        {
            $category = Category::find($category);
            
            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }

            return new CategoryResource($category);
        }
        
        

        public function update(CategoryRequest $request, Category $category)
        {
            $category->update($request->all());
        
            return new CategoryResource($category);
            
        }

        public function destroy(Category $category)
        {
            
            $category->delete();

            return response(null, 204);
            
        }

}
