<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->unsignedBigInteger('product_voltage_id')->nullable();

            $table->string('name');
            $table->string('description');

            $table->foreign('product_brand_id')->references('id')->on('product_brands')->onDelete('SET NULL');
            $table->foreign('product_voltage_id')->references('id')->on('product_voltages')->onDelete('SET NULL');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
