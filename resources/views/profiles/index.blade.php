@extends('layouts.admin')

@section('title', 'Profiles List - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography & Spacing */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    /* Adds the extra breathing room from the sidebar */
    .page-spacing {
        padding-left: clamp(2rem, 4vw, 4rem) !important;
        padding-right: clamp(2rem, 4vw, 4rem) !important;
    }

    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bg-gradient-signature {
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
    }

    /* --- ADVANCED BACKGROUND STYLING --- */
    body { 
        background-color: #f8fafc; 
        position: relative; 
        z-index: 1;
        overflow-x: hidden;
    }

    /* Ambient Pulsing Glow Orbs */
    .bg-glow-orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(120px);
        z-index: -2;
        animation: pulseGlow 10s infinite alternate ease-in-out;
        pointer-events: none;
    }
    
    .orb-1 { top: -15%; left: -10%; width: 50vw; height: 50vw; background: rgba(231, 84, 128, 0.12); }
    .orb-2 { bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: rgba(10, 10, 10, 0.08); animation-delay: -5s; }

    @keyframes pulseGlow {
        0% { transform: scale(1) translate(0, 0); opacity: 0.5; }
        100% { transform: scale(1.1) translate(20px, -20px); opacity: 0.8; }
    }

    /* Animated Floating SVGs */
    .bg-floating-element {
        position: fixed;
        z-index: -1;
        opacity: 0.05;
        pointer-events: none;
        animation: floatAnim var(--duration, 8s) ease-in-out infinite;
    }

    @keyframes floatAnim {
        0% { transform: translateY(0) rotate(var(--rot-start, 0deg)); }
        50% { transform: translateY(-30px) rotate(var(--rot-mid, 15deg)); }
        100% { transform: translateY(0) rotate(var(--rot-start, 0deg)); }
    }

    /* Page Load Animations */
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* Premium Cards */
    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    /* Floating Table Aesthetic */
    .premium-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important; /* Space between rows */
        background: transparent;
    }

    .premium-table th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: #94a3b8;
        border: none;
        padding: 0 1.5rem 0.5rem 1.5rem;
        background: transparent;
    }

    .premium-table tbody tr {
        background: rgba(255, 255, 255, 0.85); /* Slight transparency to let glow through */
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 20px;
    }

    /* Round the corners of the first and last cells to make the row look like a pill */
    .premium-table tbody tr td:first-child { border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-left: 4px solid transparent; }
    .premium-table tbody tr td:last-child { border-top-right-radius: 20px; border-bottom-right-radius: 20px; }

    .premium-table td {
        vertical-align: middle;
        border: none;
        padding: 1.2rem 1.5rem;
        color: #1e293b;
        font-weight: 600;
    }

    .premium-table tbody tr:hover {
        transform: scale(1.01) translateY(-3px);
        background: #ffffff;
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.08);
    }

    .premium-table tbody tr:hover td:first-child {
        border-left: 4px solid #e75480;
    }

    /* Glowing Premium Buttons */
    .btn-premium {
        border-radius: 14px;
        padding: 0.7rem 1.8rem;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
        position: relative;
    }

    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }

    .btn-premium-outline {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        color: #475569;
    }

    .btn-premium-outline:hover {
        border-color: #111111;
        color: #111111;
        background: #f8fafc;
    }

    /* Premium Form Inputs */
    .premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.7rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: #334155;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .premium-input:focus {
        border-color: #e75480;
        background-color: #ffffff;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
        outline: none;
    }

    .filter-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    /* Soft Action Icons */
    .action-icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        margin: 0 4px;
        text-decoration: none;
        font-size: 1.1rem;
    }

    .action-icon-btn.view:hover { background: #10b981; color: white; transform: translateY(-3px); box-shadow: 0 6px 12px rgba(16, 185, 129, 0.25); }
    .action-icon-btn.edit:hover { background: #3b82f6; color: white; transform: translateY(-3px); box-shadow: 0 6px 12px rgba(59, 130, 246, 0.25); }
    .action-icon-btn.delete:hover { background: #ef4444; color: white; transform: translateY(-3px); box-shadow: 0 6px 12px rgba(239, 68, 68, 0.25); }

</style>
@endpush

@section('content')

<div class="bg-glow-orb orb-1"></div>
<div class="bg-glow-orb orb-2"></div>

<svg width="0" height="0" class="position-absolute">
    <defs>
        <linearGradient id="signatureGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#0a0a0a" />
            <stop offset="100%" stop-color="#e75480" />
        </linearGradient>
    </defs>
</svg>

<svg class="bg-floating-element" style="top: 12%; right: 8%; width: 220px; --rot-start: 15deg; --rot-mid: 25deg; --duration: 8s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>

<svg class="bg-floating-element" style="bottom: 15%; left: 6%; width: 160px; --rot-start: -20deg; --rot-mid: -5deg; --duration: 10s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>

<svg class="bg-floating-element" style="top: 45%; left: 35%; width: 80px; --rot-start: 10deg; --rot-mid: 30deg; --duration: 6s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>

<svg class="bg-floating-element" style="top: 60%; right: 25%; width: 300px; opacity: 0.03; --rot-start: 0deg; --rot-mid: 10deg; --duration: 12s;" viewBox="0 0 100 60" fill="none" stroke="url(#signatureGradient)" stroke-width="2">
    <circle cx="35" cy="30" r="25"/>
    <circle cx="65" cy="30" r="25"/>
</svg>


<div class="container-fluid py-5 page-spacing font-sans">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Profiles Directory</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage, search, and curate your candidate profiles.</p>
        </div>

        <a href="{{ route('admin.profiles.create') }}" class="btn-premium btn-glow shadow-sm d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-plus-lg me-2 border border-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 0.7rem;"></i> 
            Add New Profile
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm animate-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #ef4444; border-radius: 16px; border-left: 4px solid #ef4444;">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">Please fix the errors below.</span>
        </div>
    @endif
    
    <div class="row g-4 mb-5 animate-card delay-1">
        <div class="col-md-6">
            <div class="premium-card p-4 p-lg-5 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 50px; height: 50px; background: rgba(231, 84, 128, 0.1); color: #e75480; font-size: 1.5rem;">
                        <i class="bi bi-cloud-upload-fill"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-dark mb-2">Import Profiles</h5>
                    <p class="text-muted fw-medium mb-4" style="font-size: 0.95rem;">Upload a bulk list of profiles via spreadsheet.</p>
                </div>

                <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="file" class="form-control premium-input" required>
                        <small class="text-muted mt-2 d-block fw-semibold">
                            Allowed formats: <span class="badge bg-light text-dark border">.xlsx</span> <span class="badge bg-light text-dark border">.csv</span>
                        </small>
                    </div>

                    <button type="submit" class="btn-premium btn-glow w-100">
                        Import Data
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="premium-card p-4 p-lg-5 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 50px; height: 50px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 1.5rem;">
                        <i class="bi bi-cloud-download-fill"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-dark mb-2">Export Profiles</h5>
                    <p class="text-muted fw-medium mb-4" style="font-size: 0.95rem;">Download all existing profiles into an Excel spreadsheet for offline backup or deep analysis.</p>
                </div>

                <a href="{{ route('admin.export') }}" class="btn-premium btn-premium-outline w-100 text-center text-decoration-none mt-auto d-flex justify-content-center align-items-center">
                    <i class="bi bi-file-earmark-excel-fill fs-5 me-2 text-success"></i> Download Report
                </a>
            </div>
        </div>
    </div>

    <div class="premium-card mb-5 animate-card delay-2">
        <div class="card-body p-4 p-lg-5">
            <h5 class="font-serif fw-bold mb-4 text-dark d-flex align-items-center">
                <i class="bi bi-funnel-fill text-muted me-2"></i> Advanced Filter
            </h5>
            
            <form method="GET" action="{{ route('admin.profiles.index') }}">
                <div class="row g-4 align-items-end">

                    <div class="col-md-3">
                        <label class="filter-label">Full Name</label>
                        <input type="text" name="name" class="form-control premium-input" placeholder="e.g. Rahul Sharma" value="{{ request('name') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control premium-input" placeholder="+91..." value="{{ request('mobile') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="filter-label">Gender</label>
                        <select name="gender" class="form-select premium-input">
                            <option value="">Any</option>
                            <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="filter-label">Marital Status</label>
                        <select name="marital_status" class="form-select premium-input">
                            <option value="">Any</option>
                            <option value="Single" {{ request('marital_status')=='Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ request('marital_status')=='Married' ? 'selected' : '' }}>Married</option>
                            <option value="Divorced" {{ request('marital_status')=='Divorced' ? 'selected' : '' }}>Divorced</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="filter-label">Caste / Gotra</label>
                        <input type="text" name="caste" class="form-control premium-input" placeholder="Search" value="{{ request('caste') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="filter-label">Birth Place</label>
                        <input type="text" name="birth_place" class="form-control premium-input" placeholder="City or State" value="{{ request('birth_place') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">DOB From</label>
                        <input type="date" name="dob_from" class="form-control premium-input" value="{{ request('dob_from') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">DOB To</label>
                        <input type="date" name="dob_to" class="form-control premium-input" value="{{ request('dob_to') }}">
                    </div>

                    <div class="col-md-2 d-flex gap-3">
                        <button type="submit" class="btn-premium btn-glow flex-grow-1 px-0 d-flex justify-content-center align-items-center">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                        <a href="{{ route('admin.profiles.index') }}" class="btn-premium btn-premium-outline flex-grow-1 px-0 text-center text-decoration-none d-flex justify-content-center align-items-center" title="Reset Filters">
                            <i class="bi bi-arrow-counterclockwise fs-5"></i>
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div class="animate-card delay-3">
        <div class="d-flex justify-content-between align-items-end mb-3 px-2">
            <h5 class="font-serif fw-bold mb-0 text-dark">Directory Results</h5>
            <span class="badge bg-white text-dark shadow-sm border px-3 py-2 fw-bold fs-6 rounded-pill">Total Found: {{ $profiles->total() }}</span>
        </div>

        <div class="table-responsive" style="overflow-x: auto; padding-bottom: 20px;">
            <table class="table premium-table w-100">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th>Candidate Identity</th>
                        <th>Contact Details</th>
                        <th>Gender</th>
                        <th>Marital Status</th>
                        <th class="text-end pe-4" width="15%">Manage</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($profiles as $profile)
                        <tr>
                            <td class="text-muted text-center fw-bold fs-6">#{{ $profile->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    @php
                                        $initial = substr($profile->first_name ?? 'U', 0, 1);
                                    @endphp
                                    <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold me-4 shadow-sm text-white bg-gradient-signature" style="width: 48px; height: 48px; font-size: 1.2rem;">
                                        {{ strtoupper($initial) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark fs-5">
                                            {{ trim($profile->first_name.' '.$profile->middle_name.' '.$profile->last_name) }}
                                        </h6>
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <i class="bi bi-geo-alt-fill text-pink me-1" style="color:#e75480;"></i>
                                            {{ $profile->birth_place ?? 'Location Unknown' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="text-dark fw-bold mb-1">
                                        <i class="bi bi-telephone-fill text-muted me-2 fs-6"></i>
                                        {{ $profile->country_code }} {{ $profile->mobile }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                @if($profile->gender == 'Female')
                                    <span class="badge rounded-pill fw-bold" style="background: rgba(231, 84, 128, 0.1); color: #e75480; padding: 8px 16px; font-size: 0.8rem;">Female</span>
                                @elseif($profile->gender == 'Male')
                                    <span class="badge rounded-pill fw-bold" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 8px 16px; font-size: 0.8rem;">Male</span>
                                @else
                                    <span class="badge rounded-pill bg-light text-dark border px-3 py-2">—</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge rounded-pill fw-bold shadow-sm" style="background: #ffffff; color: #334155; border: 1px solid #e2e8f0; padding: 8px 16px; font-size: 0.8rem;">
                                    {{ $profile->marital_status ?? 'Not Specified' }}
                                </span>
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('admin.profiles.show', $profile->id) }}" class="action-icon-btn view" title="View Profile">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="action-icon-btn edit" title="Edit Profile">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.profiles.destroy', $profile->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this profile?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-icon-btn delete" title="Delete Profile">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 bg-transparent shadow-none border-0">
                                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                                        <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                    <h4 class="font-serif fw-bold text-dark">No Candidates Found</h4>
                                    <p class="text-muted fw-medium fs-6">Try adjusting your filters or importing new profiles.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($profiles->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $profiles->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection