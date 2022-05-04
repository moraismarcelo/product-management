<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_brand_id' => $this->faker->numberBetween(1, 5),
            'product_voltage_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];
    }
}
