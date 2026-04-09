<div class="row">

    {{-- ================= PERSONAL INFORMATION ================= --}}
    <div class="col-12 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-primary shadow-sm">
            <h5 class="fw-bold text-primary mb-0">👤 Personal Information</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Title</label>
        <select name="title" class="form-control shadow-sm">
            <option value="">Select</option>
            <option value="Mr" {{ old('title', $profile->title ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
            <option value="Ms" {{ old('title', $profile->title ?? '') == 'Ms' ? 'selected' : '' }}>Ms</option>
        </select>

    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">First Name *</label>
        <input type="text" name="first_name" class="form-control shadow-sm"
       value="{{ old('first_name', $profile->first_name ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Middle Name</label>
        <input type="text" name="middle_name" class="form-control shadow-sm"
       value="{{ old('middle_name', $profile->middle_name ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control shadow-sm"
       value="{{ old('last_name', $profile->last_name ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Country Code</label>
        <select name="country_code" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($CountryCode->unique('dial_code')->sortBy('dial_code') as $code)
                <option value="{{ $code['dial_code'] }}"
                    {{ old('country_code', $profile->country_code ?? '+91') == $code['dial_code'] ? 'selected' : '' }}>
                    {{ $code['dial_code'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mobile</label>
        <input type="text" name="mobile" class="form-control shadow-sm" value="{{ old('mobile', $profile->mobile ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-control shadow-sm">
            <option value="">Select</option>
            @foreach(['Male','Female','Other'] as $g)
                <option value="{{ $g }}" {{ old('gender', $profile->gender ?? '') == $g ? 'selected' : '' }}>
                    {{ $g }}
                </option>
            @endforeach
        </select>

    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Highest Qualification</label>
        <select name="highest_qualification" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Education->sortBy('education') as $code)
                <option value="{{ $code['education'] }}"
                    {{ old('highest_qualification', $profile->highest_qualification ?? '') == $code['education'] ? 'selected' : '' }}>
                    {{ $code['education'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    
    {{-- ================= BIRTH & MARITAL ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-warning shadow-sm">
            <h5 class="fw-bold text-warning mb-0">🎂 Birth & Marital Info</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control shadow-sm" value="{{ old('dob', isset($profile) && $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('Y-m-d') : '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Time of Birth</label>
        <input type="time" name="tob" class="form-control shadow-sm" value="{{ old('tob', isset($profile) && $profile->tob ? \Carbon\Carbon::parse($profile->tob)->format('H:i') : '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Place of Birth</label>
        <select name="birth_place" id="birth_place" class="form-control shadow-sm">
            <option value="">Select District</option>
    
            @foreach($Area->unique('area')->sortBy('area') as $code)
                <option value="{{ $code['area'] }}"
                    data-state="{{ $code['state'] }}"
                    {{ old('birth_place', $profile->birth_place ?? '') == $code['area'] ? 'selected' : '' }}>
                    {{ $code['area'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Marital Status</label>
        <select name="marital_status" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach(['Single','Married','Divorced','Widowed'] as $status)
                <option value="{{ $status }}"
                    {{ old('marital_status', $profile->marital_status ?? '') == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    
    {{-- ================= PERSONAL DETAILS ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-info shadow-sm">
            <h5 class="fw-bold text-info mb-0">🧘 Personal Details</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mangal Dosh</label>
        <select name="mangal_dosh" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach(['Yes','No','Anshik'] as $dosh)
                <option value="{{ $dosh }}"
                    {{ old('mangal_dosh', $profile->mangal_dosh ?? '') == $dosh ? 'selected' : '' }}>
                    {{ $dosh }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Gotra</label>
        <select name="gotra" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Gotra->sortBy('gotra') as $gotra)
                <option value="{{ $gotra->gotra }}"
                    {{ old('gotra', $profile->gotra ?? '') == $gotra->gotra ? 'selected' : '' }}>
                    {{ $gotra->gotra }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Diet</label>
        <select name="diet" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach(['Veg','Non Veg','Jain','Vegan'] as $diet)
                <option value="{{ $diet }}"
                    {{ old('diet', $profile->diet ?? '') == $diet ? 'selected' : '' }}>
                    {{ $diet }}
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

    <div class="col-md-3 mb-3">
        <label class="form-label">Height</label>
        <div class="input-group">
            
            <select name="height_feet" class="form-control shadow-sm">
                <option value="">Feet</option>
                @for($i=1;$i<=7;$i++)
                    <option value="{{ $i }}" {{ old('height_feet', $profile->height_feet ?? '') == $i ? 'selected' : '' }}>
                        {{ $i }} Feet
                    </option>
                @endfor
            </select>
            
            <select name="height_inch" class="form-control shadow-sm">
                <option value="">Inch</option>
                @for($i=0;$i<=11;$i++)
                    <option value="{{ $i }}" {{ old('height_inch', $profile->height_inch ?? '') == $i ? 'selected' : '' }}>
                        {{ $i }} Inch
                    </option>
                @endfor
            </select>

    
        </div>
    </div>
    
    {{-- ================= PROFESSIONAL & RELIGION ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-danger shadow-sm">
            <h5 class="fw-bold text-danger mb-0">💼 Professional & Religion</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Occupation</label>
        <select name="occupation" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}"
                    {{ old('occupation', $profile->occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>
                    {{ $code['occupation'] }}
                </option>
            @endforeach
        </select>
    </div>
    
    @php
        $incomeRanges = [
            '0','0-5','5-10','10-15','15-20','20-25','25-30',
            '30-40','40-50','50-60','60-70','70-80','80-90','90-100',
            '100-125','125-150','150-175','175-200','200-225','225-250',
            '250-300','300-350','350-400','400-450','450-500',
            '500-600','600-700','700-800','800-900','900-1000',
            '1000-1100','1100-1200','1200-1300','1300-1400','1400-1500',
            '1500-1600','1600-1700','1700-1800','1800-1900','1900-2000',
            '2000-2100','2100-2200','2200-2300','2300-2400','2400-2500',
            '2500+'
        ];
    @endphp


    
    <div class="col-md-3 mb-3">
        <label class="form-label">Self Income (Lakh)</label>
        <select name="self_income" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($incomeRanges as $range)
                <option value="{{ $range }}"
                    {{ old('self_income', $profile->self_income ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Family Income (Lakh)</label>
        <select name="family_income" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($incomeRanges as $range)
                <option value="{{ $range }}"
                    {{ old('family_income', $profile->family_income ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Budget / Demand</label>
        <select name="budget_demand" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($incomeRanges as $range)
                <option value="{{ $range }}"
                    {{ old('budget_demand', $profile->budget_demand ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Religion</label>
        <select name="religion" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach(['Hinduism','Islam','Christianity','Sikhism','Buddhism','Jainism','Others'] as $religion)
                <option value="{{ $religion }}"
                    {{ old('religion', $profile->religion ?? '') == $religion ? 'selected' : '' }}>
                    {{ $religion }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Caste</label>
        <select name="caste" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Caste->sortBy('caste') as $code)
                <option value="{{ $code['caste'] }}"
                    {{ old('caste', $profile->caste ?? '') == $code['caste'] ? 'selected' : '' }}>
                    {{ $code['caste'] }}
                </option>
            @endforeach
        </select>
    </div>


    
    {{-- ================= FAMILY ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-secondary shadow-sm">
            <h5 class="fw-bold text-secondary mb-0">👨‍👩‍👧 Family Details</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Father First Name</label>
        <input type="text" name="father_first" class="form-control shadow-sm"
               value="{{ old('father_first', $profile->father_first ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Father Middle Name</label>
        <input type="text" name="father_middle" class="form-control shadow-sm"
               value="{{ old('father_middle', $profile->father_middle ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Father Last Name</label>
        <input type="text" name="father_last" class="form-control shadow-sm"
               value="{{ old('father_last', $profile->father_last ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Father Occupation</label>
        <select name="father_occupation" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}"
                    {{ old('father_occupation', $profile->father_occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>
                    {{ $code['occupation'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mother First Name</label>
        <input type="text" name="mother_first" class="form-control shadow-sm"
               value="{{ old('mother_first', $profile->mother_first ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mother Middle Name</label>
        <input type="text" name="mother_middle" class="form-control shadow-sm"
               value="{{ old('mother_middle', $profile->mother_middle ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mother Last Name</label>
        <input type="text" name="mother_last" class="form-control shadow-sm"
               value="{{ old('mother_last', $profile->mother_last ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Mother Occupation</label>
        <select name="mother_occupation" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($Occupation->sortBy('occupation') as $code)
                <option value="{{ $code['occupation'] }}"
                    {{ old('mother_occupation', $profile->mother_occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>
                    {{ $code['occupation'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Brothers</label>
        <input type="number" name="brothers" min="0" class="form-control shadow-sm"
               value="{{ old('brothers', $profile->brothers ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Sisters</label>
        <input type="number" name="sisters" min="0" class="form-control shadow-sm"
               value="{{ old('sisters', $profile->sisters ?? '') }}">
    </div>

    
    {{-- ================= ADDRESS & EDUCATION ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-success shadow-sm">
            <h5 class="fw-bold text-success mb-0">🏠 Address & Education</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">House No</label>
        <input type="text" name="house_no" class="form-control shadow-sm"
               value="{{ old('house_no', $profile->house_no ?? '') }}">
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Colony / Road</label>
        <input type="text" name="colony" class="form-control shadow-sm"
               value="{{ old('colony', $profile->colony ?? '') }}">
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">Country</label>
        <select name="country" class="form-control shadow-sm">
            <option value="">Select</option>
    
            @foreach($CountryCode->sortBy('country_name') as $code)
                <option value="{{ $code['country_name'] }}"
                    {{ old('country', $profile->country ?? 'India') == $code['country_name'] ? 'selected' : '' }}>
                    {{ $code['country_name'] }} ({{ $code['country_code'] }})
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">State</label>
        <select name="state" id="state" class="form-control shadow-sm">
            <option value="">Select State</option>
    
            @foreach($Area->unique('state')->sortBy('state') as $code)
                <option value="{{ $code['state'] }}"
                    {{ old('state', $profile->state ?? '') == $code['state'] ? 'selected' : '' }}>
                    {{ $code['state'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    <div class="col-md-3 mb-3">
        <label class="form-label">District</label>
        <select name="district" id="district" class="form-control shadow-sm">
            <option value="">Select District</option>
    
            @foreach($Area->unique('area')->sortBy('area') as $code)
                <option value="{{ $code['area'] }}"
                    data-state="{{ $code['state'] }}"
                    {{ old('district', $profile->district ?? '') == $code['area'] ? 'selected' : '' }}>
                    {{ $code['area'] }}
                </option>
            @endforeach
        </select>
    </div>

    
    {{-- ================= PROFESSIONAL & RELIGION ================= --}}
    <div class="col-12 mt-4 mb-3">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-dark shadow-sm">
            <h5 class="fw-bold text-dark mb-0"> Partner preference</h5>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Caste Barrier</label>
        <select name="caste_barrier" id="caste_barrier" class="form-control shadow-sm">
            @foreach(['Yes','No','General Only'] as $val)
                <option value="{{ $val }}"
                    {{ old('caste_barrier', $profile->caste_barrier ?? '') == $val ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Partner Income</label>
        <select name="partner_income" class="form-control shadow-sm">
            @foreach($incomeRanges as $range)
                <option value="{{ $range }}"
                    {{ old('partner_income', $profile->partner_income ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Partner Budget / Demand</label>
        <select name="partner_budget_demand" class="form-control shadow-sm">
            @foreach($incomeRanges as $range)
                <option value="{{ $range }}"
                    {{ old('partner_budget_demand', $profile->partner_budget_demand ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Horoscope</label>
        <select name="horoscope" id="horoscope" class="form-control shadow-sm">
            @foreach(['Yes','No'] as $val)
                <option value="{{ $val }}"
                    {{ old('horoscope', $profile->horoscope ?? '') == $val ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-3 mb-3">
        <label class="form-label">Area Preference</label>
        <select name="area_preference[]" id="area_preference"
                class="form-control shadow-sm select2"
                multiple>
    
            @foreach($Area->unique('state')->sortBy('state') as $code)
                <option value="{{ $code['state'] }}"
                    {{ in_array(
                        $code['state'],
                        old('area_preference', $profile->area_preference ?? [])
                    ) ? 'selected' : '' }}>
                    {{ $code['state'] }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="col-12 mt-4 mb-2">
        <div class="p-3 rounded-3 bg-light border-start border-4 border-info shadow-sm">
            <h5 class="fw-bold text-info mb-0">📸 Upload Images (Max 10)</h5>
        </div>
    </div>
    
    <div class="col-md-12 mb-3">
        <label class="form-label">Self Images</label>
    
        <div id="myDropzone" class="dropzone border rounded p-3 bg-white shadow-sm"></div>
    
        {{-- Hidden inputs (auto added via JS) --}}
        <div id="uploadedImages"></div>
    </div>
    
    {{-- Already uploaded images in EDIT --}}
    @if(isset($profile) && $profile->self_images)
        <div class="mt-3 d-flex flex-wrap gap-2">
            @foreach($profile->self_images as $img)
                <img src="{{ asset('public/storage/'.$img) }}" class="rounded" width="100" height="100" style="object-fit:cover;">
            @endforeach
        </div>
    @endif


</div>

<style>
    .form-label { font-weight: 600; }
    .border-start { border-radius: 0.5rem !important; }
</style>
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

        // Reset district selection
        $('#district').val(null).trigger('change');
    }

    // On state change
    $('#state').on('change', function () {
        filterDistricts();
    });

    // 🔥 IMPORTANT: run once for EDIT mode
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

        let input = `
            <input type="hidden" name="self_images[]" value="${response.file}">
        `;
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
