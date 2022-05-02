<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductBrand::insert([
            [
                'name' => 'Electrolux',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brastemp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fischer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
