<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        // Example rows to guide the user (Marque, Modèle, Famille, Numéro de châssis, Date, Lieu)
        return [
            ['SYM', 'NHX 125', 'SYM NHX 125 GRIS MAT', 'LXMMEA301SX060453', '2026-01-28', 'DEPOT'],
            ['KYMCO', 'Agility', 'KYMCO NOIR', 'LC2U60050S5405296', '2026-03-19', 'SHOW-ROOM'],
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
