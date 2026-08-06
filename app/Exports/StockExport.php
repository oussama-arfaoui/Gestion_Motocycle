<?php

namespace App\Exports;

use App\Models\ChassisNumber;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockExport implements FromCollection, WithHeadings, WithMapping
{
    protected $from;
    protected $to;

    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    public function collection()
    {
        $query = ChassisNumber::with('variant.category.brand');

        if (!empty($this->from)) {
            $query->whereDate('date', '>=', $this->from);
        }

        if (!empty($this->to)) {
            $query->whereDate('date', '<=', $this->to);
        }

        return $query->orderBy('date')->get();
    }

    public function map($chassis): array
    {
        $variant  = $chassis->variant;
        $category = $variant ? $variant->category : null;
        $brand    = $category ? $category->brand : null;

        return [
            $brand ? $brand->name : '',
            $category ? $category->name : '',
            $variant ? $variant->name : '',
            $chassis->chassis_number,
            $chassis->date ? Carbon::parse($chassis->date)->format('Y-m-d') : '',
            $chassis->location ?: 'DEPOT',
        ];
    }

    public function headings(): array
    {
        return [
            'Marque',
            'Modèle',
            'Famille',
            'Numéro de châssis',
            'Date',
            'Lieu',
        ];
    }
}
