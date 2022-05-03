<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use App\Http\Requests\Api\Product\StoreProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        try{
            return response()->json([
                'error' => false,
                'products' => ProductResource::collection(Product::all())
                ,200]);
        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Sorry, something went wrong :(',
            ],500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try{
            if(Product::create($request->all())){
                return response()->json([
                    'error' => false,
                    'message' => 'Product created successfully',
                ],201);
            }

            return response()->json([
                'error' => true,
                'message' => 'Sorry, something went wrong :(',
            ],500);

        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Sorry, something went wrong :(',
            ],500);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try{
            $product = Product::find($id);
            if($product){
                if($product->update($request->all())){
                    return response()->json([
                        'error' => false,
                        'message' => 'Product updated successfully',
                    ],200);
                }

                return response()->json([
                    'error' => true,
                    'message' => 'Sorry, something went wrong :(',
                ],500);



            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Product not found',
                ],404);
            }

        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Sorry, something went wrong :(',
            ],500);
        }
    }

    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            if($product){
                if($product->delete()){
                    return response()->json([
                        'error' => false,
                        'message' => 'Product deleted successfully',
                    ],200);
                }

                return response()->json([
                    'error' => true,
                    'message' => 'Sorry, something went wrong :(',
                ],500);

            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Product not found',
                ],404);
            }
        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Sorry, something went wrong :(',
            ],500);
        }
    }
}
