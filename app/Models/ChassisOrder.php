<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChassisOrder extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'total_price',
        'discount',
        'tva',
        'status',
        'user_id',
        'store_id',
        'notes',
        'comment',
        'signature',
        'signed_at',
        'signed_by',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(ChassisOrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signer()
    {
        return $this->belongsTo(User::class, 'signed_by');
    }

    public static function generateOrderNumber()
    {
        $lastOrder = self::orderBy('id', 'desc')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        return 'CO-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
    }
}
