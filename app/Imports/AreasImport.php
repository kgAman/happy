<?php

namespace App\Imports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AreasImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Area([
            'area'       => $row['area'],
            'district'   => $row['district'],
            'state'      => $row['state'],
            'country'    => $row['country'],
            'area_type'  => $row['area_type'],
        ]);
    }

    public function rules(): array
    {
        return [
            'area'       => 'required|string|max:255',
            'district'   => 'required|string|max:255',
            'state'      => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'area_type'  => 'required|string|max:100',
        ];
    }
}