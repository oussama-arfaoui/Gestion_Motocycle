<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlowCategory extends Model
{
    protected $fillable = [
        'name',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function flows()
    {
        return $this->hasMany(FinancialFlow::class, 'flow_category_id');
    }
}
