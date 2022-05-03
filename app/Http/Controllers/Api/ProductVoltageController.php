<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVoltage;

class ProductVoltageController extends Controller
{
    public function index()
    {
        try{
            return response()->json([
                'error' => false,
                'voltages' => ProductVoltage::all()
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong :('
            ]);
        }

    }
}
