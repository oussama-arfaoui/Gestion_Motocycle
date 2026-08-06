<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDebt extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'doc_type',
        'doc_number',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'order_info',
        'notes',
        'user_id',
        'store_id',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::saving(function ($debt) {
            $debt->remaining_amount = max(0, (float)$debt->total_amount - (float)$debt->paid_amount);
        });
    }
}
