<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductVoltage;
use App\Http\Requests\Api\Product\StoreProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;

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

    public function edit(Product $product)
    {
        $brands = ProductBrand::all();
        $voltages = ProductVoltage::all();

        return Inertia::render('Dashboard/Product/Edit', [
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
                    'showAlert' => true,
                ]);
            }

        }catch (\Exception $e){
           return Inertia::render('Dashboard/Product/Index',[
                'error' => true,
                'message' => 'Product creation failed',
                'showAlert' => true,
            ]);
        }
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        try{
            // dd($request->validated());
            // dd($product);
            if($product->update($request->validated())){
                return redirect()->route('dashboard.product.index')->with('error', false)->with('message', 'Product updated successfully')->with('showAlert', true);
            }
            // dd("adds");

        }catch (\Exception $e){
            dd("asdsa");
            return Inertia::render('Dashboard/Product/Index',[
                'error' => true,
                'message' => 'Product update failed',
                'showAlert' => true,
            ]);
        }
    }
}
