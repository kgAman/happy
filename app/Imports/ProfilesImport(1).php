<?php

namespace App\Imports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ProfilesImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        // UPDATE (ID PRESENT)
        if (!empty($row['id'])) {
            $profile = Profile::find($row['id']);
            if ($profile) {
                $profile->update($this->payload($row));
            }
            return;
        }

        // CREATE (ID EMPTY)
        Profile::create($this->payload($row));
    }

    private function payload(array $row): array
    {
        return [
            'title'                 => $row['title'] ?? null,
            'first_name'            => $row['first_name'] ?? null,
            'middle_name'           => $row['middle_name'] ?? null,
            'last_name'             => $row['last_name'] ?? null,
            'country_code'          => $row['country_code'] ?? null,
            'mobile'                => $row['mobile'] ?? null,
            'gender'                => $row['gender'] ?? null,
            'highest_qualification' => $row['highest_qualification'] ?? null,

            'house_no'              => $row['house_no'] ?? null,
            'colony'                => $row['colony'] ?? null,
            'country'               => $row['country'] ?? null,
            'state'                 => $row['state'] ?? null,
            'district'              => $row['district'] ?? null,

            'dob'                   => $row['dob'] ?? null,
            'tob'                   => $row['tob'] ?? null,
            'birth_place'           => $row['birth_place'] ?? null,
            'marital_status'        => $row['marital_status'] ?? null,

            'mangal_dosh'           => $row['mangal_dosh'] ?? null,
            'gotra'                 => $row['gotra'] ?? null,
            'diet'                  => $row['diet'] ?? null,
            'height_cm'             => $row['height_cm'] ?? null,

            'occupation'            => $row['occupation'] ?? null,
            'self_income'           => $row['self_income'] ?? null,
            'family_income'         => $row['family_income'] ?? null,
            'budget_demand'         => $row['budget_demand'] ?? null,

            'religion'              => $row['religion'] ?? null,
            'caste'                 => $row['caste'] ?? null,

            'father_first'          => $row['father_first'] ?? null,
            'father_middle'         => $row['father_middle'] ?? null,
            'father_last'           => $row['father_last'] ?? null,
            'father_occupation'     => $row['father_occupation'] ?? null,

            'mother_first'          => $row['mother_first'] ?? null,
            'mother_middle'         => $row['mother_middle'] ?? null,
            'mother_last'           => $row['mother_last'] ?? null,
            'mother_occupation'     => $row['mother_occupation'] ?? null,

            'brothers'              => $row['brothers'] ?? 0,
            'sisters'               => $row['sisters'] ?? 0,

            'caste_barrier'         => $row['caste_barrier'] ?? null,
            'partner_income'        => $row['partner_income'] ?? null,
            'partner_budget_demand' => $row['partner_budget_demand'] ?? null,
            'horoscope'             => $row['horoscope'] ?? null,

            'area_preference'       => isset($row['area_preference'])
                ? array_map('trim', explode(',', $row['area_preference']))
                : [],
        ];
    }
}
