<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChassisOrderItem extends Model
{
    protected $fillable = [
        'chassis_order_id',
        'chassis_number_id',
        'variant_id',
        'chassis_number',
        'model_name',
        'family_name',
        'brand_name',
        'price',
        'location',
    ];

    public function order()
    {
        return $this->belongsTo(ChassisOrder::class, 'chassis_order_id');
    }

    public function chassisNumberRecord()
    {
        return $this->belongsTo(ChassisNumber::class, 'chassis_number_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
