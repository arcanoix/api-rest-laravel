<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/**
* @OA\Info(
*             title="API Rest", 
*             version="1.0",
*             description="services restfull"
* )
*
* @OA\Server(url="http://127.0.0.1:8000")
*
* @OAS\SecurityScheme(
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer
*/
class CategoryController extends Controller
{
        
    /**
     * List categories all records
     * @OA\Get (
     *     path="/api/categories",
     *     tags={"categories"},
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
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */ 
        public function index(): JsonResource
        {                
                $categories = Category::get();
            
                return CategoryResource::collection($categories);
        }


        /**
         * @OA\Post(
         *     path="/api/categories",
         *     summary="Adds a new category",
         *     tags={"categories"},
         *      security={{"sanctum":{}}},
         *     @OA\RequestBody(
         *         @OA\MediaType(
         *             mediaType="application/json",
         *             @OA\Schema(
         *                 @OA\Property(
         *                     property="name",
         *                     type="string"
         *                 )
         *             )
         *         )
         *     ),
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
     *                     )
     *                 )
     *             ),
         *         )
         *     )
         * )
         */
        public function store (CategoryRequest $request)
        {
            $category = Category::create($request->all());
        
            return new CategoryResource($category);
        }



        /**
         * Show one row to category
         * @OA\Get (
         *     path="/api/categories/{id}",
         *     tags={"categories"},
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
         *              @OA\Property(property="id", type="number", example=1),
         *              @OA\Property(property="name", type="string", example="Example")
         *         )
         *     ),
         *      @OA\Response(
         *          response=404,
         *          description="NOT FOUND",
         *          @OA\JsonContent(
         *              @OA\Property(property="message", type="string", example="category not found"),
         *          )
         *      )
         * )
         */
        public function show($category)
        {
            $category = Category::find($category);
            
            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }

            return new CategoryResource($category);
        }
        
        
        /**
         * @OA\Put(
         *     path="/api/categories/{id}",
         *     summary="Updates a category",
         *     tags={"categories"},
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
         *                     property="name",
         *                     type="string"
         *                 )
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
         *          )
         *      )
         * )
         */
        public function update(CategoryRequest $request, $category)
        {
            $category = Category::find($category);
            
            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }

            $category->update($request->all());
        
            return new CategoryResource($category);
            
        }


        /**
         * @OA\Delete(
         *      path="/api/categories/{id}",
         *      tags={"categories"},
         *      summary="Delete Category",
         *     security={{"sanctum":{}}},
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
        public function destroy($category)
        {
            $category = Category::find($category);
            
            if(!$category)
            {
                return response()->json(['message' => 'category not found'], 404);
            }
            
            $category->delete();

            return response(null, 204);
            
        }

}
