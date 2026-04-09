<style>
    /* Typography Overrides */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }

    /* ========================================================
       PREMIUM GLOBAL INPUTS & DROPDOWNS 
       ======================================================== */
    .premium-input, 
    select.form-select.premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.7rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: #334155;
        background-color: #ffffff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        cursor: pointer;
    }

    /* Custom SVG Arrow for Standard Selects */
    select.form-select.premium-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e75480' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-size: 16px 12px;
    }

    .premium-input:focus, 
    select.form-select.premium-input:focus {
        border-color: #e75480;
        background-color: #ffffff;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
        outline: none;
    }

    .premium-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Section Header Banners */
    .section-header-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: transform 0.3s ease;
    }
    
    .section-header-card:hover {
        transform: translateX(8px);
        border-color: rgba(231, 84, 128, 0.2);
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(231, 84, 128, 0.25);
    }

    /* Glowing Premium Buttons */
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.8rem 2rem;
        font-weight: 700;
        font-size: 1.1rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }


    /* ========================================================
       SELECT2 PLUGIN MASTER OVERRIDES (Makes it look custom)
       ======================================================== */
    /* 1. The main input box */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        min-height: 46px;
        padding: 4px 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--multiple {
        border-color: #e75480;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
    }
    
    /* Center the selected text */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 34px;
        color: #334155;
        font-weight: 500;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px;
        right: 10px;
    }
    
    /* Selected Tags (Multi-select) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fff0f5;
        border: 1px solid #fbcfe8;
        color: #e75480;
        border-radius: 8px;
        padding: 4px 10px;
        font-weight: 600;
        margin-top: 5px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #e75480;
        border-right: none;
        margin-right: 5px;
        transition: color 0.2s;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background: transparent;
        color: #be185d;
    }

    /* 2. The Dropdown Popup List */
    .select2-dropdown {
        border: 2px solid #e2e8f0;
        border-radius: 16px !important; /* Rounded corners for the popup */
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow: hidden;
        margin-top: 5px;
        z-index: 9999;
    }
    
    /* The search bar inside the dropdown */
    .select2-search--dropdown .select2-search__field {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 8px 12px;
    }
    .select2-search--dropdown .select2-search__field:focus {
        border-color: #e75480;
        outline: none;
        box-shadow: 0 0 0 3px rgba(231, 84, 128, 0.1);
    }

    /* Individual List Options */
    .select2-results__option {
        padding: 10px 16px;
        color: #475569;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    /* Hover State for List Options */
    .select2-container--default .select2-results__option--highlighted[aria-selected],
    .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
        background-color: #e75480 !important;
        color: white !important;
        font-weight: 600;
    }

    /* Already Selected State */
    .select2-container--default .select2-results__option[aria-selected="true"] {
        background-color: #f8fafc;
        color: #e75480;
        position: relative;
    }
    .select2-container--default .select2-results__option[aria-selected="true"]::after {
        content: '✓';
        position: absolute;
        right: 16px;
        font-family: bootstrap-icons !important;
    }


    /* Dropzone Plugin Overrides */
    .dropzone {
        border: 2px dashed #cbd5e1 !important;
        border-radius: 16px !important;
        background: #f8fafc !important;
        transition: all 0.3s ease;
        min-height: 150px;
    }
    .dropzone:hover {
        border-color: #e75480 !important;
        background: #fff0f5 !important;
    }
</style>

<div class="row g-4 font-sans pb-5">
    
    {{-- ================= PERSONAL INFORMATION ================= --}}
    <div class="col-12 mt-2 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-person-vcard-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Personal Information</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Title</label>
        <select name="title" class="form-select premium-input">
            <option value="">Select</option>
            <option value="Mr" {{ old('title', $profile->title ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
            <option value="Ms" {{ old('title', $profile->title ?? '') == 'Ms' ? 'selected' : '' }}>Ms</option>
            <option value="Mrs" {{ old('title', $profile->title ?? '') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
            <option value="Dr" {{ old('title', $profile->title ?? '') == 'Dr' ? 'selected' : '' }}>Dr</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">First Name *</label>
        <input type="text" name="first_name" class="form-control premium-input" value="{{ old('first_name', $profile->first_name ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Last Name</label>
        <input type="text" name="last_name" class="form-control premium-input" value="{{ old('last_name', $profile->last_name ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Country Code *</label>
        <select name="country_code" class="form-select premium-input select2" required>
            <option value="">Select</option>
            @foreach($CountryCode->unique('dial_code')->sortBy('dial_code') as $code)
                <option value="{{ $code['dial_code'] }}" {{ old('country_code', $profile->country_code ?? '+91') == $code['dial_code'] ? 'selected' : '' }}>
                    {{ $code['dial_code'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Mobile *</label>
        <input type="text" name="mobile" class="form-control premium-input" value="{{ old('mobile', $profile->mobile ?? '') }}" required>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Alternate Mobile</label>
        <input type="text" name="alternate_mobile" class="form-control premium-input" value="{{ old('alternate_mobile', $profile->alternate_mobile ?? '') }}">
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Email</label>
        <input type="email" name="email" class="form-control premium-input" value="{{ old('email', $profile->email ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Gender *</label>
        <select name="gender" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['male','female','other'] as $g)
                <option value="{{ $g }}" {{ old('gender', $profile->gender ?? '') == $g ? 'selected' : '' }}>{{ mb_convert_case($g, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>


    {{-- ================= BIRTH & PHYSICAL ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-calendar2-heart-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Birth & Physical Details</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control premium-input" value="{{ old('dob', isset($profile) && $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Time of Birth</label>
        <input type="time" name="tob" class="form-control premium-input" value="{{ old('tob', isset($profile) && $profile->tob ? \Carbon\Carbon::parse($profile->tob)->format('H:i') : '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Place of Birth</label>
        <select name="birth_place" id="birth_place" class="form-select premium-input select2">
            <option value="">Select District</option>
            @foreach($Area->unique('area')->sortBy('area') as $code)
                <option value="{{ $code['area'] }}" data-state="{{ $code['state'] }}" {{ old('birth_place', $profile->birth_place ?? '') == $code['area'] ? 'selected' : '' }}>
                    {{ $code['area'] }}
                </option>
            @endforeach
        </select>
    </div>

    @php
        if (!empty($profile->height_cm)) {
            $totalInches = round($profile->height_cm / 2.54);
            $profile->height_feet = intdiv($totalInches, 12);
            $profile->height_inch = $totalInches % 12;
        }
    @endphp
    
    <div class="col-md-3">
        <label class="premium-label">Height</label>
        <div class="input-group gap-2">
            <select name="height_feet" class="form-select premium-input" style="border-radius: 12px; width: 45%;">
                <option value="">Feet</option>
                @for($i=1; $i<=7; $i++)
                    <option value="{{ $i }}" {{ old('height_feet', $profile->height_feet ?? '') == $i ? 'selected' : '' }}>{{ $i }} ft</option>
                @endfor
            </select>
            <select name="height_inch" class="form-select premium-input" style="border-radius: 12px; width: 45%;">
                <option value="">Inch</option>
                @for($i=0; $i<=11; $i++)
                    <option value="{{ $i }}" {{ old('height_inch', $profile->height_inch ?? '') == $i ? 'selected' : '' }}>{{ $i }} in</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Weight (kg)</label>
        <input type="number" step="0.1" name="weight_kg" class="form-control premium-input" value="{{ old('weight_kg', $profile->weight_kg ?? '') }}">
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Blood Group</label>
        <select name="blood_group" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                <option value="{{ $bg }}" {{ old('blood_group', $profile->blood_group ?? '') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Complexion</label>
        <select name="complexion" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['very_fair','fair','wheatish','dark'] as $complexion)
                <option value="{{ $complexion }}" {{ old('complexion', $profile->complexion ?? '') == $complexion ? 'selected' : '' }}>{{ mb_convert_case($complexion, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Body Type</label>
        <select name="body_type" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['slim','average','athletic','heavy'] as $body_type)
                <option value="{{ $body_type }}" {{ old('body_type', $profile->body_type ?? '') == $body_type ? 'selected' : '' }}>{{ mb_convert_case($body_type, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Physical Status</label>
        <select name="physical_status" class="form-select premium-input">
            @foreach(['normal','physically_challenged'] as $physical_status)
                <option value="{{ $physical_status }}" {{ old('physical_status', $profile->physical_status ?? '') == $physical_status ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $physical_status), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>


    {{-- ================= MARITAL STATUS ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-rings fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Marital Status</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Marital Status *</label>
        <select name="marital_status" class="form-select premium-input" required>
            <option value="">Select</option>
            @foreach(['single','separated','divorced','widowed', 'awaiting_divorce'] as $status)
                <option value="{{ $status }}" {{ old('marital_status', $profile->marital_status ?? '') == $status ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $status), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Children (if any)</label>
        <input type="number" name="children" min="0" class="form-control premium-input" value="{{ old('children', $profile->children ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Children Living With</label>
        <select name="children_living_with" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['self','partner','joint'] as $children_living_with)
                <option value="{{ $children_living_with }}" {{ old('children_living_with', $profile->children_living_with ?? '') == $children_living_with ? 'selected' : '' }}>{{ mb_convert_case($children_living_with, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Divorce Details</label>
        <textarea name="divorce_details" class="form-control premium-input" rows="1" style="min-height: 46px;">{{ old('divorce_details', $profile->divorce_details ?? '') }}</textarea>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Widow/Widower Details</label>
        <textarea name="widow_widower_details" class="form-control premium-input" rows="1" style="min-height: 46px;">{{ old('widow_widower_details', $profile->widow_widower_details ?? '') }}</textarea>
    </div>


    {{-- ================= PERSONAL & HOROSCOPE ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-moon-stars-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Personal & Horoscope</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Mangal Dosh</label>
        <select name="mangal_dosh" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['yes','no','anshik'] as $dosh)
                <option value="{{ $dosh }}" {{ old('mangal_dosh', $profile->mangal_dosh ?? '') == $dosh ? 'selected' : '' }}>{{ mb_convert_case($dosh, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Gotra</label>
        <select name="gotra" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Gotra->sortBy('gotra') as $gotra)
                <option value="{{ $gotra->gotra }}" {{ old('gotra', $profile->gotra ?? '') == $gotra->gotra ? 'selected' : '' }}>{{ $gotra->gotra }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Diet</label>
        <select name="diet" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['vegetarian','non_vegetarian','eggetarian','vegan','jain'] as $diet)
                <option value="{{ $diet }}" {{ old('diet', $profile->diet ?? '') == $diet ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $diet), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Drinking Habits</label>
        <select name="drinking_habits" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['never','occasionally','regularly'] as $val)
                <option value="{{ $val }}" {{ old('drinking_habits', $profile->drinking_habits ?? '') == $val ? 'selected' : '' }}>{{ mb_convert_case($val, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>


    {{-- ================= EDUCATION & PROFESSION ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-mortarboard-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Education & Profession</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Highest Qualification</label>
        <select name="highest_qualification" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Education->sortBy('education') as $code)
                <option value="{{ $code['education'] }}" {{ old('highest_qualification', $profile->highest_qualification ?? '') == $code['education'] ? 'selected' : '' }}>
                    {{ $code['education'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Occupation</label>
        <select name="occupation" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}" {{ old('occupation', $profile->occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>
                    {{ $code['occupation'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Designation</label>
        <input type="text" name="designation" class="form-control premium-input" value="{{ old('designation', $profile->designation ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Company Name</label>
        <input type="text" name="company_name" class="form-control premium-input" value="{{ old('company_name', $profile->company_name ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Industry</label>
        <input type="text" name="industry" class="form-control premium-input" value="{{ old('industry', $profile->industry ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Job Type</label>
        <select name="job_type" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['government','private','business','not_working','student'] as $jt)
                <option value="{{ $jt }}" {{ old('job_type', $profile->job_type ?? '') == $jt ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $jt), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Self Income (₹ in lakhs)</label>
        <input type="number" step="0.01" name="self_income" class="form-control premium-input" value="{{ old('self_income', $profile->self_income ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Family Income (₹ in lakhs)</label>
        <input type="number" step="0.01" name="family_income" class="form-control premium-input" value="{{ old('family_income', $profile->family_income ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Budget (₹ in lakhs)</label>
        <input type="number" step="0.01" name="budget_demand" class="form-control premium-input" value="{{ old('budget_demand', $profile->budget_demand ?? '') }}">
    </div>


    {{-- ================= RELIGION & COMMUNITY ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-bank2 fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Religion & Community</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Religion</label>
        <select name="religion" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['Hinduism','Islam','Christianity','Sikhism','Buddhism','Jainism','Others'] as $religion)
                <option value="{{ $religion }}" {{ old('religion', $profile->religion ?? '') == $religion ? 'selected' : '' }}>{{ $religion }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Caste</label>
        <select name="caste" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Caste->sortBy('caste') as $code)
                <option value="{{ $code['caste'] }}" {{ old('caste', $profile->caste ?? '') == $code['caste'] ? 'selected' : '' }}>{{ $code['caste'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 d-none">
        <label class="premium-label">Languages Known</label>
        <select name="languages_known[]" class="form-select premium-input select2" multiple>
            @php
                $selectedLangs = old('languages_known', $profile->languages_known ?? []);
            @endphp
            @foreach(['Hindi','English','Gujarati','Marathi','Tamil','Telugu','Kannada','Malayalam','Bengali','Punjabi','Urdu','Others'] as $lang)
                <option value="{{ $lang }}" {{ in_array($lang, $selectedLangs) ? 'selected' : '' }}>{{ $lang }}</option>
            @endforeach
        </select>
    </div>


    {{-- ================= FAMILY BACKGROUND ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-house-heart-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Family Background</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Father First Name</label>
        <input type="text" name="father_first" class="form-control premium-input" value="{{ old('father_first', $profile->father_first ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Father Last Name</label>
        <input type="text" name="father_last" class="form-control premium-input" value="{{ old('father_last', $profile->father_last ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Father Occupation</label>
        <select name="father_occupation" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}" {{ old('father_occupation', $profile->father_occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Father Alive?</label>
        <select name="father_alive" class="form-select premium-input">
            <option value="1" {{ old('father_alive', $profile->father_alive ?? '') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('father_alive', $profile->father_alive ?? '') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Mother First Name</label>
        <input type="text" name="mother_first" class="form-control premium-input" value="{{ old('mother_first', $profile->mother_first ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Mother Last Name</label>
        <input type="text" name="mother_last" class="form-control premium-input" value="{{ old('mother_last', $profile->mother_last ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Mother Occupation</label>
        <select name="mother_occupation" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}" {{ old('mother_occupation', $profile->mother_occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Mother Alive?</label>
        <select name="mother_alive" class="form-select premium-input">
            <option value="1" {{ old('mother_alive', $profile->mother_alive ?? '') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('mother_alive', $profile->mother_alive ?? '') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">No. of Brothers</label>
        <input type="number" name="no_of_brothers" min="0" class="form-control premium-input" value="{{ old('no_of_brothers', $profile->no_of_brothers ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">No. of Sisters</label>
        <input type="number" name="no_of_sisters" min="0" class="form-control premium-input" value="{{ old('no_of_sisters', $profile->no_of_sisters ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Married Brothers</label>
        <input type="number" name="married_brothers" min="0" class="form-control premium-input" value="{{ old('married_brothers', $profile->married_brothers ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Married Sisters</label>
        <input type="number" name="married_sisters" min="0" class="form-control premium-input" value="{{ old('married_sisters', $profile->married_sisters ?? '') }}">
    </div>


    {{-- ================= ADDRESS ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-geo-alt-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Address Details</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">House No</label>
        <input type="text" name="house_no" class="form-control premium-input" value="{{ old('house_no', $profile->house_no ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="premium-label">Colony/Road</label>
        <input type="text" name="colony" class="form-control premium-input" value="{{ old('colony', $profile->colony ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="premium-label">Street</label>
        <input type="text" name="street" class="form-control premium-input" value="{{ old('street', $profile->street ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="premium-label">Pincode</label>
        <input type="text" name="pincode" class="form-control premium-input" value="{{ old('pincode', $profile->pincode ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">City</label>
        <input type="text" name="city" class="form-control premium-input" value="{{ old('city', $profile->city ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">District</label>
        <select name="district" id="district" class="form-select premium-input select2">
            <option value="">Select District</option>
            @foreach($Area->unique('area')->sortBy('area') as $code)
                <option value="{{ $code['area'] }}" data-state="{{ $code['state'] }}" {{ old('district', $profile->district ?? '') == $code['area'] ? 'selected' : '' }}>{{ $code['area'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">State</label>
        <select name="state" id="state" class="form-select premium-input select2">
            <option value="">Select State</option>
            @foreach($Area->unique('state')->sortBy('state') as $code)
                <option value="{{ $code['state'] }}" {{ old('state', $profile->state ?? '') == $code['state'] ? 'selected' : '' }}>{{ $code['state'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Country *</label>
        <select name="country" class="form-select premium-input select2" required>
            <option value="">Select</option>
            @foreach($CountryCode->sortBy('country_name') as $code)
                <option value="{{ $code['country_name'] }}" {{ old('country', $profile->country ?? 'India') == $code['country_name'] ? 'selected' : '' }}>{{ $code['country_name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="premium-label">Current Address</label>
        <textarea name="current_address" class="form-control premium-input" rows="2">{{ old('current_address', $profile->current_address ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="premium-label">Permanent Address</label>
        <textarea name="permanent_address" class="form-control premium-input" rows="2">{{ old('permanent_address', $profile->permanent_address ?? '') }}</textarea>
    </div>


    {{-- ================= PARTNER PREFERENCES ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-hearts fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Partner Preferences</h4>
        </div>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Caste Barrier</label>
        <select name="caste_barrier" class="form-select premium-input">
            <option value="1" {{ old('caste_barrier', $profile->caste_barrier ?? '') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('caste_barrier', $profile->caste_barrier ?? '') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Min Age</label>
        <input type="number" name="partner_min_age" class="form-control premium-input" value="{{ old('partner_min_age', $profile->partner_min_age ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Max Age</label>
        <input type="number" name="partner_max_age" class="form-control premium-input" value="{{ old('partner_max_age', $profile->partner_max_age ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Min Height (cm)</label>
        <input type="number" step="0.1" name="partner_min_height" class="form-control premium-input" value="{{ old('partner_min_height', $profile->partner_min_height ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Max Height (cm)</label>
        <input type="number" step="0.1" name="partner_max_height" class="form-control premium-input" value="{{ old('partner_max_height', $profile->partner_max_height ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Religion</label>
        <input type="text" name="partner_religion" class="form-control premium-input" value="{{ old('partner_religion', $profile->partner_religion ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Caste</label>
        <input type="text" name="partner_caste" class="form-control premium-input" value="{{ old('partner_caste', $profile->partner_caste ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Occupation</label>
        <select name="partner_occupation" class="form-select premium-input select2">
            <option value="">Select</option>
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}" {{ old('occupation', $profile->occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>
                    {{ $code['occupation'] }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Income (₹ in lakhs)</label>
        <input type="number" step="0.01" name="partner_income" class="form-control premium-input" value="{{ old('partner_income', $profile->partner_income ?? '') }}">
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Budget/Demand (₹ in lakhs)</label>
        <input type="number" step="0.01" name="partner_budget_demand" class="form-control premium-input" value="{{ old('partner_budget_demand', $profile->partner_budget_demand ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="premium-label">Marital Status</label>
        <select name="partner_marital_status" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['single','separated','divorced','widowed', 'awaiting_divorce'] as $status)
                <option value="{{ $status }}" {{ old('partner_marital_status', $profile->partner_marital_status ?? '') == $status ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $status), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Mangal Dosh</label>
        <select name="partner_mangal_dosh" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['yes','no','anshik'] as $dosh)
                <option value="{{ $dosh }}" {{ old('partner_mangal_dosh', $profile->partner_mangal_dosh ?? '') == $dosh ? 'selected' : '' }}>{{ mb_convert_case($dosh, MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3">
        <label class="premium-label">Diet</label>
        <select name="partner_diet" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['vegetarian','non_vegetarian','eggetarian','vegan','jain'] as $diet)
                <option value="{{ $diet }}" {{ old('partner_diet', $profile->partner_diet ?? '') == $diet ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $diet), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Physical Status</label>
        <select name="partner_physical_status" class="form-select premium-input">
            <option value="">Select</option>
            @foreach(['normal','physically_challenged'] as $physical_status)
                <option value="{{ $physical_status }}" {{ old('partner_physical_status', $profile->partner_physical_status ?? '') == $physical_status ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $physical_status), MB_CASE_TITLE, 'UTF-8') }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="premium-label">Horoscope Required?</label>
        <select name="horoscope" class="form-select premium-input">
            <option value="1" {{ old('horoscope', $profile->horoscope ?? '') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('horoscope', $profile->horoscope ?? '') == '0' ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="col-md-9">
        <label class="premium-label">Area Preference</label>
        <select name="area_preference[]" id="area_preference" class="form-select premium-input select2" multiple>
            @php
                $selectedAreas = old('area_preference', $profile->area_preference ?? []);
            @endphp
            @foreach($Area->unique('state')->sortBy('state') as $code)
                <option value="{{ $code['state'] }}" {{ in_array($code['state'], $selectedAreas) ? 'selected' : '' }}>{{ $code['state'] }}</option>
            @endforeach
        </select>
    </div>


    {{-- ================= MEDIA ================= --}}
    <div class="col-12 mt-5 mb-2">
        <div class="d-flex align-items-center p-3 section-header-card">
            <div class="icon-wrapper me-3">
                <i class="bi bi-camera-fill fs-5 text-white"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Media Uploads</h4>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <label class="premium-label">Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control premium-input" accept="image/*">
        @if(isset($profile) && $profile->profile_photo)
            <div class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm">
                <img src="{{ asset('storage/profiles/'.$profile->profile_photo) }}" width="120" class="rounded-3" style="object-fit: cover;">
            </div>
        @endif
    </div>

    <div class="col-md-6 mb-4">
        <label class="premium-label">Horoscope Image</label>
        <input type="file" name="horoscope_image" class="form-control premium-input" accept="image/*">
        @if(isset($profile) && $profile->horoscope_image)
            <div class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm">
                <img src="{{ asset('storage/'.$profile->horoscope_image) }}" width="120" class="rounded-3" style="object-fit: cover;">
            </div>
        @endif
    </div>

    <div class="col-md-6 mb-4">
        <label class="premium-label">Family Images (multiple)</label>
        <input type="file" name="family_images[]" class="form-control premium-input" accept="image/*" multiple>
        @if(isset($profile) && $profile->family_images)
            <div class="mt-3 p-2 border rounded-4 bg-white d-flex flex-wrap gap-2 shadow-sm">
                @foreach($profile->family_images as $img)
                    <img src="{{ asset('storage/'.$img) }}" width="80" height="80" class="rounded-3" style="object-fit: cover;">
                @endforeach
            </div>
        @endif
    </div>

    <div class="col-md-6 mb-4">
        <label class="premium-label">Video Profile</label>
        <input type="file" name="video_profile" class="form-control premium-input" accept="video/*">
        @if(isset($profile) && $profile->video_profile)
            <div class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm">
                <video width="200" class="rounded-3" controls><source src="{{ asset('storage/'.$profile->video_profile) }}"></video>
            </div>
        @endif
    </div>

    <div class="col-md-12 mb-5">
        <label class="premium-label">Self Images Gallery (Max 10)</label>
        <div id="myDropzone" class="dropzone shadow-sm d-flex flex-column justify-content-center align-items-center text-muted">
            <i class="bi bi-cloud-upload-fill fs-1 text-pink mb-2" style="color: #e75480;"></i>
            <h6 class="font-sans fw-bold">Drag & Drop images here</h6>
            <small>or click to browse</small>
        </div>
        <div id="uploadedImages"></div>
        @if(isset($profile) && $profile->self_images)
            <div class="mt-4 p-3 border rounded-4 bg-white d-flex flex-wrap gap-3 shadow-sm">
                @foreach($profile->self_images as $img)
                    <img src="{{ asset('storage/'.$img) }}" class="rounded-3 shadow-sm" width="100" height="100" style="object-fit:cover;">
                @endforeach
            </div>
        @endif
    </div>

    {{-- Hidden fields --}}
    <input type="hidden" name="user_id" value="{{ old('user_id', $profile->user_id ?? '') }}">
    <input type="hidden" name="profile_id" value="{{ old('profile_id', $profile->profile_id ?? '') }}">
    <input type="hidden" name="profile_completion" value="{{ old('profile_completion', $profile->profile_completion ?? '') }}">
    <input type="hidden" name="is_verified" value="{{ old('is_verified', $profile->is_verified ?? '') }}">
    <input type="hidden" name="is_premium" value="{{ old('is_premium', $profile->is_premium ?? '') }}">
    <input type="hidden" name="is_active" value="{{ old('is_active', $profile->is_active ?? '1') }}">

    <div class="col-12 mt-5 mb-5 d-flex justify-content-end">
        <button type="submit" class="btn-glow px-5 py-3 fs-5">
            <i class="bi bi-floppy-fill me-2"></i> Save Candidate Profile
        </button>
    </div>
</div>

<script>
$(document).ready(function () {
    // Initialize Select2
    $('.select2').select2({ width: '100%' });

    function filterDistricts() {
        let state = $('#state').val();
        $('#district option').each(function () {
            let optionState = $(this).data('state');
            if (!state || !optionState || optionState === state) {
                $(this).prop('disabled', false);
            } else {
                $(this).prop('disabled', true);
            }
        });
        $('#district').val(null).trigger('change');
    }

    $('#state').on('change', function () {
        filterDistricts();
    });

    filterDistricts();
});

Dropzone.autoDiscover = false;

var uploadedImages = 0;
var dz = new Dropzone("#myDropzone", {
    url: "{{ route('admin.profiles.upload-image') }}",
    maxFilesize: 5, // 5 MB
    maxFiles: 10,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
        uploadedImages++;
        let input = `<input type="hidden" name="self_images[]" value="${response.file}">`;
        document.getElementById('uploadedImages').insertAdjacentHTML('beforeend', input);
        file.serverFilename = response.file;
    },
    removedfile: function (file) {
        uploadedImages--;
        if (file.serverFilename) {
            document.querySelector(`input[value="${file.serverFilename}"]`)?.remove();
        }
        file.previewElement.remove();
    }
});
</script>