<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;

class ProductBrandController extends Controller
{
    public function index()
    {
        try{
            return response()->json([
                'error' => false,
                'brands' => ProductBrand::all()
            ]);

        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong :('
            ]);
        }

    }
}
