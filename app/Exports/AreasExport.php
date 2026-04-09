<?php

namespace App\Exports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AreasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Area::all(['area', 'district', 'state', 'country', 'area_type']);
    }

    public function headings(): array
    {
        return ['area', 'district', 'state', 'country', 'area_type'];
    }
}