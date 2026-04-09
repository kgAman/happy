<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProfilesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Profile::all();
    }

    public function headings(): array
    {
        return [
            'id',

            'title','first_name','middle_name','last_name',
            'country_code','mobile','gender','highest_qualification',

            'house_no','colony','country','state','district',

            'dob','tob','birth_place','marital_status',

            'mangal_dosh','gotra','diet','height_cm',

            'occupation','self_income','family_income','budget_demand',

            'religion','caste',

            'father_first','father_middle','father_last','father_occupation',
            'mother_first','mother_middle','mother_last','mother_occupation',

            'brothers','sisters',

            'caste_barrier','partner_income','partner_budget_demand',
            'horoscope','area_preference'
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,

            $row->title,
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            $row->country_code,
            $row->mobile,
            $row->gender,
            $row->highest_qualification,

            $row->house_no,
            $row->colony,
            $row->country,
            $row->state,
            $row->district,

            $row->dob?->format('d-m-Y'),
            $row->tob,
            $row->birth_place,
            $row->marital_status,

            $row->mangal_dosh,
            $row->gotra,
            $row->diet,
            $row->height_cm,

            $row->occupation,
            $row->self_income,
            $row->family_income,
            $row->budget_demand,

            $row->religion,
            $row->caste,

            $row->father_first,
            $row->father_middle,
            $row->father_last,
            $row->father_occupation,

            $row->mother_first,
            $row->mother_middle,
            $row->mother_last,
            $row->mother_occupation,

            $row->brothers,
            $row->sisters,

            $row->caste_barrier,
            $row->partner_income,
            $row->partner_budget_demand,
            $row->horoscope,

            is_array($row->area_preference)
                ? implode(',', $row->area_preference)
                : null,
        ];
    }
}
