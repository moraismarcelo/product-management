<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_brand_id',
        'product_voltage_id',
        'name',
        'description'
    ];

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }

    public function voltage()
    {
        return $this->belongsTo(ProductVoltage::class, 'product_voltage_id');
    }
}
