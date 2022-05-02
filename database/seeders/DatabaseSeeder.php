<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //add admin user to database

        $this->call(ProductBrandsTableSeeder::class);
        $this->call(ProductVoltagesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
         ]);
    }
}
