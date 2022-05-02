<?php

namespace Database\Seeders;

use App\Models\ProductVoltage;
use Illuminate\Database\Seeder;

class ProductVoltagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVoltage::insert([
            [
                'voltage' => '110v',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voltage' => '220v',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voltage' => '110v/220v',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
