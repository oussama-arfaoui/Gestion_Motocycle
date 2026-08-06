<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialFlow extends Model
{
    protected $fillable = [
        'date',
        'designation',
        'flow_category_id',
        'type',
        'payment_mode',
        'amount',
        'reference',
        'source',
        'chassis_order_id',
        'chassis_order_item_id',
        'purchase_price',
        'sale_price',
        'store_id',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'date'           => 'date',
        'amount'         => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'sale_price'     => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(FlowCategory::class, 'flow_category_id');
    }

    public function order()
    {
        return $this->belongsTo(ChassisOrder::class, 'chassis_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Bénéfice de la ligne (uniquement pertinent pour les ventes).
     */
    public function getBenefitAttribute()
    {
        if ($this->sale_price !== null && $this->purchase_price !== null) {
            return (float) $this->sale_price - (float) $this->purchase_price;
        }
        return null;
    }
}
