<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChassisOrder extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'doc_type',
        'doc_number',
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
        $yearSuffix = now()->format('y');
        $max = self::maxOrderNumberForYear($yearSuffix);
        return 'N' . ($max + 1) . '/' . $yearSuffix;
    }

    private static function maxOrderNumberForYear($yearSuffix)
    {
        $yearRegex = '^N([0-9]+)/' . $yearSuffix . '$';
        $max = self::whereRaw('order_number REGEXP ?', [$yearRegex])->get()
            ->map(function ($o) use ($yearSuffix) {
                if (preg_match('/^N([0-9]+)\/' . preg_quote($yearSuffix, '/') . '$/', $o->order_number, $m)) {
                    return (int) $m[1];
                }
                return 0;
            })->max();
        return $max ?: 1541;
    }
}
