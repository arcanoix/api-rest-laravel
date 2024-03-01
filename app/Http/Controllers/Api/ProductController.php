<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
        {                
                $products = Product::get();
            
                return ProductResource::collection($products);
        }


        public function store (Request $request)
        {
            $product = Product::create($request->all());
        
            return new ProductResource($product);
        }


        public function show(Product $product)
        {
            return new ProductResource($product);
        }
        
        

        public function update(Request $request, Product $product)
        {
            $product->update($request->all());
        
            return new ProductResource($product);
            
        }

        public function destroy(Product $product)
        {
            
            $product->delete();

            return response(null, 204);
            
        }
}
