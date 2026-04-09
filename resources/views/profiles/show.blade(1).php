@extends('layouts.app')

@section('title', trim($profile->first_name.' '.$profile->last_name))

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-light">
            <i class="bi bi-person-circle me-2"></i>Complete Profile Details
        </h3>
        <a href="{{ route('admin.profiles.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            {{-- ================= BASIC ================= --}}
            <h5 class="fw-bold text-primary mb-3">Basic Information</h5>
            <div class="row">
                <div class="col-md-4"><strong>Title:</strong> {{ $profile->title ?? '—' }}</div>
                <div class="col-md-4"><strong>First Name:</strong> {{ $profile->first_name ?? '—' }}</div>
                <div class="col-md-4"><strong>Middle Name:</strong> {{ $profile->middle_name ?? '—' }}</div>
                <div class="col-md-4"><strong>Last Name:</strong> {{ $profile->last_name ?? '—' }}</div>
                <div class="col-md-4"><strong>Gender:</strong> {{ $profile->gender ?? '—' }}</div>
                <div class="col-md-4"><strong>Mobile:</strong> {{ $profile->country_code }} {{ $profile->mobile }}</div>
                <div class="col-md-4"><strong>Qualification:</strong> {{ $profile->highest_qualification ?? '—' }}</div>
            </div>

            <hr>

            {{-- ================= ADDRESS ================= --}}
            <h5 class="fw-bold text-success mb-3">Address Details</h5>
            <div class="row">
                <div class="col-md-4"><strong>House No:</strong> {{ $profile->house_no ?? '—' }}</div>
                <div class="col-md-4"><strong>Colony:</strong> {{ $profile->colony ?? '—' }}</div>
                <div class="col-md-4"><strong>District:</strong> {{ $profile->district ?? '—' }}</div>
                <div class="col-md-4"><strong>State:</strong> {{ $profile->state ?? '—' }}</div>
                <div class="col-md-4"><strong>Country:</strong> {{ $profile->country ?? '—' }}</div>
            </div>

            <hr>

            {{-- ================= BIRTH ================= --}}
            <h5 class="fw-bold text-danger mb-3">Birth Details</h5>
            <div class="row">
                <div class="col-md-4"><strong>DOB:</strong> {{ $profile->dob->format('d-m-Y') ?? '—' }}</div>
                <div class="col-md-4"><strong>TOB:</strong> {{ $profile->tob ?? '—' }}</div>
                <div class="col-md-4"><strong>Birth Place:</strong> {{ $profile->birth_place ?? '—' }}</div>
                <div class="col-md-4"><strong>Marital Status:</strong> {{ $profile->marital_status ?? '—' }}</div>
            </div>

            <hr>

            {{-- ================= PERSONAL ================= --}}
            <h5 class="fw-bold text-warning mb-3">Personal Details</h5>
            <div class="row">
                <div class="col-md-4"><strong>Religion:</strong> {{ $profile->religion ?? '—' }}</div>
                <div class="col-md-4"><strong>Caste:</strong> {{ $profile->caste ?? '—' }}</div>
                <div class="col-md-4"><strong>Gotra:</strong> {{ $profile->gotra ?? '—' }}</div>
                <div class="col-md-4"><strong>Mangal Dosh:</strong> {{ $profile->mangal_dosh ?? '—' }}</div>
                <div class="col-md-4"><strong>Diet:</strong> {{ $profile->diet ?? '—' }}</div>
                <div class="col-md-4">
                    <strong>Height:</strong>
                    @if($profile->height_feet !== null)
                        {{ $profile->height_feet }}' {{ $profile->height_inch }}" 
                        <span class="text-muted">({{ $profile->height_cm }} cm)</span>
                    @else
                        —
                    @endif
                </div>

            </div>

            <hr>

            {{-- ================= PROFESSIONAL ================= --}}
            <h5 class="fw-bold text-info mb-3">Professional Details</h5>
            <div class="row">
                <div class="col-md-4"><strong>Occupation:</strong> {{ $profile->occupation ?? '—' }}</div>
                <div class="col-md-4"><strong>Self Income:</strong> ₹{{ ($profile->self_income ?? 0) }}</div>
                <div class="col-md-4"><strong>Family Income:</strong> ₹{{ ($profile->family_income ?? 0) }}</div>
                <div class="col-md-4"><strong>Budget Demand:</strong> ₹{{ ($profile->budget_demand ?? 0) }}</div>
            </div>

            <hr>

            {{-- ================= FAMILY ================= --}}
            <h5 class="fw-bold text-secondary mb-3">Family Details</h5>
            <div class="row">
                <div class="col-md-6">
                    <strong>Father:</strong>
                    {{ trim($profile->father_first.' '.$profile->father_middle.' '.$profile->father_last) ?: '—' }}
                    ({{ $profile->father_occupation ?? '—' }})
                </div>
                <div class="col-md-6">
                    <strong>Mother:</strong>
                    {{ trim($profile->mother_first.' '.$profile->mother_middle.' '.$profile->mother_last) ?: '—' }}
                    ({{ $profile->mother_occupation ?? '—' }})
                </div>
                <div class="col-md-4"><strong>Brothers:</strong> {{ $profile->brothers ?? 0 }}</div>
                <div class="col-md-4"><strong>Sisters:</strong> {{ $profile->sisters ?? 0 }}</div>
            </div>

            <hr>

            {{-- ================= PARTNER PREF ================= --}}
            <h5 class="fw-bold text-dark mb-3">Partner Preferences</h5>
            <div class="row">
                <div class="col-md-4"><strong>Caste Barrier:</strong> {{ $profile->caste_barrier ?? '—' }}</div>
                <div class="col-md-4"><strong>Partner Income:</strong> {{ $profile->partner_income ?? '—' }}</div>
                <div class="col-md-4"><strong>Partner Budget:</strong> {{ $profile->partner_budget_demand ?? '—' }}</div>
                <div class="col-md-4"><strong>Horoscope:</strong> {{ $profile->horoscope ?? '—' }}</div>
                <div class="col-md-8">
                    <strong>Area Preference:</strong>
                    {{ is_array($profile->area_preference) ? implode(', ', $profile->area_preference) : '—' }}
                </div>
            </div>

            <hr>

            {{-- ================= IMAGES ================= --}}
            <h5 class="fw-bold text-warning mb-3">Images</h5>

            @if(!empty($profile->self_images))
                <div class="row g-3">
                    @foreach($profile->self_images as $img)
                        <div class="col-md-3 col-6">
                            <img src="{{ asset('public/storage/'.$img) }}"
                                 class="img-fluid rounded shadow preview-image"
                                 style="height:180px; object-fit:cover; cursor:pointer;"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imagePreviewModal"
                                 data-image="{{ asset('public/storage/'.$img) }}">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No images uploaded.</p>
            @endif

        </div>
    </div>
</div>
<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body text-center p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"></button>
                <img id="previewModalImage" src=""
                     class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('imagePreviewModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const img = event.relatedTarget;
            const imageSrc = img.getAttribute('data-image');
            document.getElementById('previewModalImage').src = imageSrc;
        });
    });
</script>
@endsection
