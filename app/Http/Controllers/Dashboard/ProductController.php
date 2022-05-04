<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductVoltage;
use App\Http\Requests\Api\Product\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Product/Index');
    }

    public function create()
    {
        return Inertia::render('Dashboard/Product/Create',
            [
                'brands' => ProductBrand::all(),
                'voltages' => ProductVoltage::all(),
            ]);
    }

    public function form($productId = null)
    {
        $product = Product::findOrFail($productId);

        $brands = ProductBrand::all();
        $voltages = ProductVoltage::all();

        return Inertia::render('Dashboard/Product/Form', [
            'product' => $product,
            'brands' => $brands,
            'voltages' => $voltages,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        try{
            if(Product::create($request->validated())){
                return Inertia::render('Dashboard/Product/Index',[
                    'error' => false,
                    'message' => 'Product created successfully',
                ]);
            }

        }catch (\Exception $e){
           return Inertia::render('Dashboard/Product/Index',[
                'error' => true,
                'message' => 'Product creation failed',
            ]);
        }
    }
}
