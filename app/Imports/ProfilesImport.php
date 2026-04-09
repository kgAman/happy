<?php

namespace App\Imports;

use App\Models\Profile;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ProfilesImport implements OnEachRow, WithHeadingRow
{
    /**
     * Process each row.
     */
    public function onRow(Row $row)
    {
        $data = $row->toArray();

        // Update if ID is provided and profile exists
        if (!empty($data['id'])) {
            $profile = Profile::find($data['id']);
            if ($profile) {
                $profile->update($this->preparePayload($data));
            }
            return;
        }

        // Create new profile
        Profile::create($this->preparePayload($data));
    }

    /**
     * Transform raw row data to match model fillable fields.
     */
    private function preparePayload(array $data): array
    {
        // ===== Helper for boolean fields =====
        $toBoolean = function ($value): ?bool {
            if (is_null($value)) return null;
            if (is_bool($value)) return $value;
            if (in_array(strtolower($value), ['yes', 'true', '1'], true)) return true;
            if (in_array(strtolower($value), ['no', 'false', '0'], true)) return false;
            return null;
        };

        // ===== Helper for array fields (comma separated) =====
        $toArray = function ($value): array {
            if (empty($value)) return [];
            if (is_array($value)) return $value;
            // Split by comma, trim each element, remove empty strings
            return array_filter(array_map('trim', explode(',', $value)));
        };

        // ===== Helper for JSON fields =====
        $toJsonArray = function ($value): ?array {
            if (empty($value)) return null;
            if (is_array($value)) return $value;
            $decoded = json_decode($value, true);
            return (json_last_error() === JSON_ERROR_NONE) ? $decoded : null;
        };

        // ===== Height conversion (if feet/inch provided) =====
        $heightCm = null;
        if (!empty($data['height_cm'])) {
            $heightCm = (float) $data['height_cm'];
        } elseif (!empty($data['height_feet']) || !empty($data['height_inch'])) {
            $feet = (int) ($data['height_feet'] ?? 0);
            $inch = (int) ($data['height_inch'] ?? 0);
            $heightCm = round((($feet * 12) + $inch) * 2.54);
        }

        // ===== Build payload =====
        return [
            // BASIC INFORMATION
            'title'                 => $data['title'] ?? null,
            'first_name'            => $data['first_name'] ?? null,
            'middle_name'           => $data['middle_name'] ?? null,
            'last_name'             => $data['last_name'] ?? null,
            'full_name'             => $data['full_name'] ?? null,
            'country_code'          => $data['country_code'] ?? null,
            'mobile'                => $data['mobile'] ?? null,
            'alternate_mobile'      => $data['alternate_mobile'] ?? null,
            'email'                 => $data['email'] ?? null,
            'gender'                => $data['gender'] ?? null,
            'highest_qualification' => $data['highest_qualification'] ?? null,
            'other_qualification'   => $data['other_qualification'] ?? null,
            'institution_name'      => $data['institution_name'] ?? null,

            // ADDRESS
            'house_no'              => $data['house_no'] ?? null,
            'colony'                => $data['colony'] ?? null,
            'street'                => $data['street'] ?? null,
            'landmark'              => $data['landmark'] ?? null,
            'pincode'               => $data['pincode'] ?? null,
            'city'                  => $data['city'] ?? null,
            'taluka'                => $data['taluka'] ?? null,
            'district'              => $data['district'] ?? null,
            'state'                 => $data['state'] ?? null,
            'country'               => $data['country'] ?? null,
            'current_address'       => $data['current_address'] ?? null,
            'permanent_address'     => $data['permanent_address'] ?? null,
            'native_place'          => $data['native_place'] ?? null,

            // BIRTH & PHYSICAL
            'dob'                   => !empty($data['dob']) ? Carbon::parse($data['dob']) : null,
            'tob'                   => $data['tob'] ?? null,
            'birth_place'           => $data['birth_place'] ?? null,
            'age'                   => $data['age'] ?? null,
            'height_cm'             => $heightCm,
            'weight_kg'             => isset($data['weight_kg']) ? (float) $data['weight_kg'] : null,
            'blood_group'           => $data['blood_group'] ?? null,
            'complexion'            => $data['complexion'] ?? null,
            'body_type'             => $data['body_type'] ?? null,
            'physical_status'       => $data['physical_status'] ?? null,
            'hobbies'               => $toArray($data['hobbies'] ?? null),
            'interests'             => $toArray($data['interests'] ?? null),

            // MARITAL STATUS
            'marital_status'        => $data['marital_status'] ?? null,
            'children'              => isset($data['children']) ? (int) $data['children'] : null,
            'children_living_with'  => $data['children_living_with'] ?? null,
            'divorce_details'       => $data['divorce_details'] ?? null,
            'widow_widower_details' => $data['widow_widower_details'] ?? null,

            // PERSONAL & HOROSCOPE
            'mangal_dosh'           => $data['mangal_dosh'] ?? null,
            'nakshatra'             => $data['nakshatra'] ?? null,
            'rashi'                 => $data['rashi'] ?? null,
            'charan'                => $data['charan'] ?? null,
            'gan'                   => $data['gan'] ?? null,
            'nadi'                  => $data['nadi'] ?? null,
            'gotra'                 => $data['gotra'] ?? null,
            'diet'                  => $data['diet'] ?? null,
            'drinking_habits'       => $data['drinking_habits'] ?? null,
            'smoking_habits'        => $data['smoking_habits'] ?? null,
            'about_myself'          => $data['about_myself'] ?? null,
            'family_values'         => $data['family_values'] ?? null,

            // PROFESSIONAL
            'occupation'            => $data['occupation'] ?? null,
            'designation'           => $data['designation'] ?? null,
            'company_name'          => $data['company_name'] ?? null,
            'industry'              => $data['industry'] ?? null,
            'job_type'              => $data['job_type'] ?? null,
            'business_type'         => $data['business_type'] ?? null,
            'annual_income'         => isset($data['annual_income']) ? (float) $data['annual_income'] : null,
            'self_income'           => isset($data['self_income']) ? (float) $data['self_income'] : null,
            'family_income'         => isset($data['family_income']) ? (float) $data['family_income'] : null,
            'budget_demand'         => isset($data['budget_demand']) ? (float) $data['budget_demand'] : null,
            'property_details'      => $data['property_details'] ?? null,
            'vehicle_details'       => $data['vehicle_details'] ?? null,

            // RELIGION & COMMUNITY
            'religion'              => $data['religion'] ?? null,
            'caste'                 => $data['caste'] ?? null,
            'sub_caste'             => $data['sub_caste'] ?? null,
            'mother_tongue'         => $data['mother_tongue'] ?? null,
            'languages_known'       => $toArray($data['languages_known'] ?? null),
            'ethnicity'             => $data['ethnicity'] ?? null,
            'community'             => $data['community'] ?? null,

            // FAMILY BACKGROUND
            'father_first'          => $data['father_first'] ?? null,
            'father_middle'         => $data['father_middle'] ?? null,
            'father_last'           => $data['father_last'] ?? null,
            'father_occupation'     => $data['father_occupation'] ?? null,
            'father_alive'          => $toBoolean($data['father_alive'] ?? null),
            'mother_first'          => $data['mother_first'] ?? null,
            'mother_middle'         => $data['mother_middle'] ?? null,
            'mother_last'           => $data['mother_last'] ?? null,
            'mother_occupation'     => $data['mother_occupation'] ?? null,
            'mother_alive'          => $toBoolean($data['mother_alive'] ?? null),
            'family_type'           => $data['family_type'] ?? null,
            'family_status'         => $data['family_status'] ?? null,
            'no_of_brothers'        => isset($data['no_of_brothers']) ? (int) $data['no_of_brothers'] : null,
            'no_of_sisters'         => isset($data['no_of_sisters']) ? (int) $data['no_of_sisters'] : null,
            'married_brothers'      => isset($data['married_brothers']) ? (int) $data['married_brothers'] : null,
            'married_sisters'       => isset($data['married_sisters']) ? (int) $data['married_sisters'] : null,
            'family_location'       => $data['family_location'] ?? null,

            // PARTNER PREFERENCES
            'partner_min_age'           => isset($data['partner_min_age']) ? (int) $data['partner_min_age'] : null,
            'partner_max_age'           => isset($data['partner_max_age']) ? (int) $data['partner_max_age'] : null,
            'partner_min_height'        => isset($data['partner_min_height']) ? (float) $data['partner_min_height'] : null,
            'partner_max_height'        => isset($data['partner_max_height']) ? (float) $data['partner_max_height'] : null,
            'partner_religion'          => $data['partner_religion'] ?? null,
            'partner_caste'             => $data['partner_caste'] ?? null,
            'partner_sub_caste'         => $data['partner_sub_caste'] ?? null,
            'partner_qualification'     => $data['partner_qualification'] ?? null,
            'partner_occupation'        => $data['partner_occupation'] ?? null,
            'partner_income'            => isset($data['partner_income']) ? (float) $data['partner_income'] : null,
            'partner_country'           => $data['partner_country'] ?? null,
            'partner_state'             => $data['partner_state'] ?? null,
            'partner_city'              => $data['partner_city'] ?? null,
            'partner_location'          => $data['partner_location'] ?? null,
            'partner_marital_status'    => $data['partner_marital_status'] ?? null,
            'partner_mangal_dosh'       => $data['partner_mangal_dosh'] ?? null,
            'partner_diet'              => $data['partner_diet'] ?? null,
            'partner_complexion'        => $data['partner_complexion'] ?? null,
            'partner_physical_status'   => $data['partner_physical_status'] ?? null,
            'partner_family_background' => $data['partner_family_background'] ?? null,
            'partner_description'       => $data['partner_description'] ?? null,
            'caste_barrier'             => $toBoolean($data['caste_barrier'] ?? null),
            'partner_budget_demand'     => isset($data['partner_budget_demand']) ? (float) $data['partner_budget_demand'] : null,
            'horoscope'                 => $toBoolean($data['horoscope'] ?? null),
            'area_preference'           => $toArray($data['area_preference'] ?? null),
            'other_preferences'         => $data['other_preferences'] ?? null,

            // MEDIA
            'profile_photo'             => $data['profile_photo'] ?? null,
            'profile_photo_verified'    => $toBoolean($data['profile_photo_verified'] ?? null),
            'self_images'               => $toArray($data['self_images'] ?? null),
            'horoscope_image'           => $data['horoscope_image'] ?? null,
            'family_images'             => $toArray($data['family_images'] ?? null),
            'video_profile'             => $data['video_profile'] ?? null,

            // SYSTEM & STATUS
            'user_id'                   => isset($data['user_id']) ? (int) $data['user_id'] : null,
            'profile_id'                => $data['profile_id'] ?? null,
            'profile_completion'        => isset($data['profile_completion']) ? (int) $data['profile_completion'] : null,
            'profile_views'             => isset($data['profile_views']) ? (int) $data['profile_views'] : null,
            'shortlisted_count'         => isset($data['shortlisted_count']) ? (int) $data['shortlisted_count'] : null,
            'is_verified'               => $toBoolean($data['is_verified'] ?? null),
            'verification_level'        => $data['verification_level'] ?? null,
            'verification_date'         => !empty($data['verification_date']) ? Carbon::parse($data['verification_date']) : null,
            'is_premium'                => $toBoolean($data['is_premium'] ?? null),
            'premium_expiry'            => !empty($data['premium_expiry']) ? Carbon::parse($data['premium_expiry']) : null,
            'is_active'                 => $toBoolean($data['is_active'] ?? null),
            'is_featured'               => $toBoolean($data['is_featured'] ?? null),
            'is_online'                 => $toBoolean($data['is_online'] ?? null),
            'last_login'                => !empty($data['last_login']) ? Carbon::parse($data['last_login']) : null,
            'profile_created_by'        => $data['profile_created_by'] ?? null,
            'match_score'               => isset($data['match_score']) ? (int) $data['match_score'] : null,
            'privacy_settings'          => $toJsonArray($data['privacy_settings'] ?? null),
            'contact_visibility'        => $data['contact_visibility'] ?? null,
            'photo_visibility'          => $data['photo_visibility'] ?? null,
            'horoscope_visibility'      => $data['horoscope_visibility'] ?? null,

            // REGISTRATION DETAILS
            'registered_by'             => $data['registered_by'] ?? null,
            'registration_date'         => !empty($data['registration_date']) ? Carbon::parse($data['registration_date']) : null,
            'payment_status'            => $toBoolean($data['payment_status'] ?? null),
            'membership_type'           => $data['membership_type'] ?? null,
            'membership_expiry'         => !empty($data['membership_expiry']) ? Carbon::parse($data['membership_expiry']) : null,

            // ADDITIONAL DETAILS
            'expectations_from_partner' => $data['expectations_from_partner'] ?? null,
            'about_family'              => $data['about_family'] ?? null,
            'hobbies_interests'         => $data['hobbies_interests'] ?? null,
            'career_ambitions'          => $data['career_ambitions'] ?? null,
            'religious_beliefs'         => $data['religious_beliefs'] ?? null,
            'lifestyle'                 => $data['lifestyle'] ?? null,
            'personality_traits'        => $data['personality_traits'] ?? null,
            'health_information'        => $data['health_information'] ?? null,
            'education_details'         => $toJsonArray($data['education_details'] ?? null),
            'work_experience'           => $toJsonArray($data['work_experience'] ?? null),
            'skills'                    => $toJsonArray($data['skills'] ?? null),
            'achievements'              => $toJsonArray($data['achievements'] ?? null),
            'travel_history'            => $toJsonArray($data['travel_history'] ?? null),
            'settlement_plans'          => $data['settlement_plans'] ?? null,

            // CONTACT PREFERENCES
            'contact_preference'        => $toArray($data['contact_preference'] ?? null),
            'contact_timings'           => $data['contact_timings'] ?? null,
            'contact_through'           => $data['contact_through'] ?? null,
            'allow_direct_contact'      => $toBoolean($data['allow_direct_contact'] ?? null),

            // ADMIN FIELDS
            'admin_notes'               => $data['admin_notes'] ?? null,
            'admin_rating'              => isset($data['admin_rating']) ? (int) $data['admin_rating'] : null,
            'profile_score'             => isset($data['profile_score']) ? (int) $data['profile_score'] : null,
            'reported_count'            => isset($data['reported_count']) ? (int) $data['reported_count'] : null,
            'blocked_count'             => isset($data['blocked_count']) ? (int) $data['blocked_count'] : null,
            'rejection_reason'          => $data['rejection_reason'] ?? null,
            'approval_status'           => $data['approval_status'] ?? null,
            'approved_by'               => isset($data['approved_by']) ? (int) $data['approved_by'] : null,
            'approved_date'             => !empty($data['approved_date']) ? Carbon::parse($data['approved_date']) : null,
        ];
    }
}