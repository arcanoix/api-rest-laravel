<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    /**
     * List products all records
     * @OA\Get (
     *     path="/api/products",
     *     tags={"products"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="0.00"
     *                     ),
     *                    
     *                  @OA\Property(property="category", type="object",
    *                      @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="name", type="string", example="example")
 *                      ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */ 
    public function index()
        {                
                $products = Product::get();
            
                return ProductResource::collection($products);
        }


        /**
         * @OA\Post(
         *     path="/api/products",
         *     summary="Create a new product",
         *     tags={"products"},
         *     security={{"sanctum":{}}},
         *     @OA\RequestBody(
         *         @OA\MediaType(
         *             mediaType="application/json",
         *             @OA\Schema(
         *                 @OA\Property(
         *                     property="name",
         *                     type="string"
         *                 ),
         *                  @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="0.00"
     *                     ),
     *                      @OA\Property(
     *                         property="category",
     *                         type="integer",
     *                         example="1"
     *                     )
         *             )
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="OK",
         *         @OA\JsonContent(
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="0.00"
     *                     ),
     *                      @OA\Property(property="category", type="object",
    *                      @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="name", type="string", example="example")
 *                      ),
         *         ),
         *          
         *      ),
         * @OA\Response(
         *          response=404,
         *          description="NOT FOUND",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="category not found"),
         *          )
         *     )
         * )
         */
        public function store (Request $request)
        {
            
            $category = Category::find($request->get('category'));

            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }

            $product = Product::create($request->all());
        
            return new ProductResource($product);
        }


            /**
         * Show one row to product
         * @OA\Get (
         *     path="/api/products/{id}",
         *     tags={"products"},
         *     security={{"sanctum":{}}},
         *     @OA\Parameter(
         *         in="path",
         *         name="id",
         *         required=true,
         *         @OA\Schema(type="string")
         *     ),
       
         *     @OA\Response(
         *         response=200,
         *         description="OK",
         *         @OA\JsonContent(
         *             @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="0.00"
     *                     ),
     *                      @OA\Property(property="category", type="object",
    *                      @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="name", type="string", example="example")
 *                      ),
         *         )
         *     ),
         *      @OA\Response(
         *          response=404,
         *          description="NOT FOUND",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="product not found"),
         *          )
         *      )
         * )
         */
        public function show($product)
        {
            $product = Product::find($product);

            if(!$product)
            {
                return response()->json(['message' => 'product not found'], 404);
            }

            return new ProductResource($product);
        }
        
        
         /**
         * @OA\Put(
         *     path="/api/products/{id}",
         *     summary="Updates a product",
         *     tags={"products"},
         *     security={{"sanctum":{}}},
         *     @OA\Parameter(
         *         description="Parameter with mutliple examples",
         *         in="path",
         *         name="id",
         *         required=true,
         *         @OA\Schema(type="string"),
         *         @OA\Examples(example="int", value="1", summary="An int value."),
         *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
         *     ),
         *       @OA\RequestBody(
         *         @OA\MediaType(
         *             mediaType="application/json",
         *             @OA\Schema(
         *                 @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="0.00"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="integer",
     *                         example="1"
     *                     ),
         *             )
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="OK"
         *     ),
         *    @OA\Response(
         *          response=404,
         *          description="NOT FOUND",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="category not found"),
         *          ),
         *      ),
         * )
         */
        public function update(Request $request, $product)
        {
            $category = Category::find($request->get('category'));

            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }

            $product = Product::find($product);

            if(!$product)
            {
                return response()->json(['message' => 'product not found'], 404);
            }

            $product->update($request->all());
        
            return new ProductResource($product);
            
        }

        /**
         * @OA\Delete(
         *      path="/api/products/{id}",
         *      tags={"products"},
         *     security={{"sanctum":{}}},
         *      summary="Delete Product",
         *       @OA\Parameter(
         *         description="Parameter with mutliple examples",
         *         in="path",
         *         name="id",
         *         required=true,
         *         @OA\Schema(type="string"),
         *         @OA\Examples(example="int", value="1", summary="An int value."),
         *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
         *     ),
         *      @OA\Response(
         *          response=204,
         *          description="Success"
         *      ),
         *     @OA\Response(
         *          response=404,
         *          description="NOT FOUND",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="category not found"),
         *          )
         *      )
         * )
         */
        public function destroy($product)
        {
            $product = Product::find($product);

            if(!$product)
            {
                return response()->json(['message' => 'product not found'], 404);
            }

            $product->delete();

            return response(null, 204);
            
        }
}
