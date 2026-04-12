@extends('layouts.master')

@section('title', 'My Dashboard | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    :root {
        --brand-pink: #e75480;
        --brand-pink-light: rgba(231, 84, 128, 0.1);
        --text-dark: #1a0f1c; 
        --bg-light: #f8fafc;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
        position: relative;
        overflow-x: hidden;
        min-height: 100vh;
    }

    .font-serif { font-family: 'Playfair Display', serif; }
    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* --- BACKGROUND SVGS --- */
    .bg-matrimony-patterns { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .floating-svg { position: absolute; fill: none; stroke-width: 1.5; animation: floatMatrimony var(--duration) ease-in-out infinite alternate; }
    .svg-rings { top: 15%; left: 5%; width: 280px; height: 280px; --duration: 14s; transform: rotate(-15deg); stroke: rgba(231, 84, 128, 0.08); }
    .svg-mandala { top: 50%; right: -5%; width: 550px; height: 550px; --duration: 25s; animation: rotateSlow 80s linear infinite; stroke: rgba(17, 17, 17, 0.04); }
    .svg-heart { bottom: 12%; left: 18%; width: 200px; height: 200px; --duration: 10s; transform: rotate(10deg); fill: rgba(231, 84, 128, 0.05); stroke: none;}
    @keyframes rotateSlow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    @keyframes floatMatrimony { 0% { transform: translateY(0) rotate(0deg) scale(1); } 100% { transform: translateY(-40px) rotate(8deg) scale(1.05); } }

    /* --- LAYOUT & CONTAINERS --- */
    .dashboard-container { position: relative; z-index: 10; max-width: 1400px; margin: 40px auto 100px; padding: 0 30px; }
    
    .premium-card {
        background: #ffffff; border-radius: 24px; padding: 35px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05);
    }

    /* --- SIDEBAR NAV --- */
    .sidebar-nav { display: flex; flex-direction: column; gap: 8px; }
    .sidebar-link {
        display: flex; align-items: center; gap: 12px; padding: 14px 20px;
        border-radius: 16px; color: #475569; font-weight: 600; font-size: 1.05rem;
        text-decoration: none; transition: all 0.3s ease; border: 1px solid transparent; cursor: pointer;
    }
    .sidebar-link i { font-size: 1.2rem; transition: transform 0.3s; }
    .sidebar-link:hover { background: #f8fafc; color: #111827; border-color: #f1f5f9; }
    .sidebar-link:hover i { transform: scale(1.1); color: var(--brand-pink); }
    
    .sidebar-link.active {
        background: linear-gradient(90deg, #111111 0%, var(--brand-pink) 100%);
        color: #ffffff; box-shadow: 0 8px 20px rgba(231, 84, 128, 0.25);
    }
    .sidebar-link.active i { color: #ffffff; }

    /* --- CONTENT PANES --- */
    .tab-pane { display: none; animation: fadeIn 0.4s ease forwards; }
    .tab-pane.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    /* --- BUTTONS --- */
    .btn-action-solid {
        background: linear-gradient(135deg, #111111 0%, var(--brand-pink) 100%);
        color: white; border: none; padding: 12px 30px; border-radius: 50px;
        font-weight: 600; font-size: 1rem; display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(231, 84, 128, 0.25); cursor: pointer;
    }
    .btn-action-solid:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(231, 84, 128, 0.4); color: white; }
    
    .btn-action-outline {
        background: #ffffff; color: #475569; border: 2px solid #e2e8f0; padding: 10px 25px;
        border-radius: 50px; font-weight: 600; transition: all 0.2s; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-action-outline:hover { background: #f8fafc; border-color: #111111; color: #111111; }

    /* --- INPUTS & FORMS --- */
    .premium-input {
        border-radius: 12px; border: 2px solid #f1f5f9; padding: 0.7rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.95rem; font-weight: 500;
        color: #334155; background-color: #ffffff; transition: all 0.3s ease; width: 100%;
    }
    select.premium-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e75480' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-size: 16px 12px; background-repeat: no-repeat; background-position: right 1rem center;
        appearance: none;
    }
    .premium-input:focus { border-color: #e75480; box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1); outline: none; }
    .premium-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin-bottom: 0.5rem; display: block; }
    .form-section-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: #111827; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-top: 30px; margin-bottom: 20px; }

    /* --- PROFILE DISPLAY HERO --- */
    .detail-hero-card { display: flex; gap: 35px; align-items: center; padding-bottom: 30px; border-bottom: 1px solid #f1f5f9; margin-bottom: 30px; }
    .detail-img-box { width: 160px; height: 160px; background: #e2e8f0; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 4px solid #ffffff; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .detail-img-box img { width: 100%; height: 100%; object-fit: cover; }
    .detail-badge-id { display: inline-flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; padding: 4px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; color: #64748b; margin-bottom: 10px; }
    .detail-name { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: #111827; margin-bottom: 10px; line-height: 1.1; }
    .detail-stats { display: flex; gap: 20px; color: #6b7280; font-size: 0.95rem; font-weight: 500; flex-wrap: wrap; }
    .detail-stats span { display: flex; align-items: center; gap: 6px; }
    .detail-stats i { color: #e75480; }

    /* --- ACCORDIONS / DATA GRIDS --- */
    .data-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 25px; background: #f8fafc; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9; margin-bottom: 25px; }
    .data-item { display: flex; flex-direction: column; gap: 6px; }
    .data-item-header { display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-item-header i { color: #fecdd3; font-size: 1.1rem; }
    .data-value { font-size: 1.05rem; font-weight: 700; color: #111827; padding-left: 26px; } 
    .section-title { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: #111827; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }

    /* --- MATCHES GRID --- */
    .matches-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
    .match-card { background: #ffffff; border: 1px solid #f1f5f9; border-radius: 20px; overflow: hidden; transition: all 0.3s ease; text-align: center; padding-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .match-card:hover { transform: translateY(-5px); border-color: var(--brand-pink); box-shadow: 0 15px 30px rgba(231, 84, 128, 0.15); }
    .match-img { width: 100%; height: 220px; object-fit: cover; }
    .match-info { padding: 20px 15px 10px; }
    .match-name { font-size: 1.2rem; font-weight: 700; color: #111827; margin-bottom: 5px; }
    .match-details { font-size: 0.9rem; color: #64748b; margin-bottom: 15px; }
    .match-badge { display: inline-flex; align-items: center; gap: 5px; background: rgba(231, 84, 128, 0.1); color: #e75480; font-size: 0.85rem; font-weight: 700; padding: 6px 16px; border-radius: 50px; }

    @media (max-width: 991px) {
        .dashboard-container { padding: 0 15px; }
        .detail-hero-card { flex-direction: column; text-align: center; }
        .detail-stats { justify-content: center; }
    }
</style>
@endpush

@section('content')

<div class="bg-matrimony-patterns d-none d-lg-block">
    <svg class="floating-svg svg-rings" viewBox="0 0 100 100"><circle cx="35" cy="50" r="25" /><circle cx="65" cy="50" r="25" /></svg>
    <svg class="floating-svg svg-heart" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
</div>

<div class="dashboard-container">
    <div class="row g-4">
        
        <div class="col-lg-3">
            <div class="premium-card p-4 sticky-top" style="top: 100px;">
                
                <div class="text-center mb-4 pb-4 border-bottom">
                    <div class="detail-img-box mx-auto mb-3" style="width: 100px; height: 100px;">
                        <img src="{{ auth()->user()->profile?->profile_photo ? asset('storage/'.auth()->user()->profile->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=e75480&color=fff' }}" alt="User">
                    </div>
                    <h5 class="fw-bold m-0">{{ auth()->user()->name ?? 'My Account' }}</h5>
                    <small class="text-muted fw-medium">{{ auth()->user()->profile?->profile_id ?? 'New Member' }}</small>
                </div>

                <div class="sidebar-nav">
                    <a class="sidebar-link active" onclick="switchTab('view-profile', this)">
                        <i class="bi bi-person-vcard"></i> My Profile
                    </a>
                    <a class="sidebar-link" onclick="switchTab('edit-profile', this)">
                        <i class="bi bi-pencil-square"></i> Edit Details
                    </a>
                    <a class="sidebar-link" onclick="switchTab('my-matches', this)">
                        <i class="bi bi-hearts"></i> My Matches
                        <span class="badge bg-danger ms-auto rounded-pill">12</span>
                    </a>
                    <a class="sidebar-link mt-4 text-danger border-top pt-4" style="border-radius: 0;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right text-danger"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="premium-card">

                @php
                    $user = auth()->user();
                    $p = $user->profile;
                    
                    $name = ($p && $p->first_name) ? trim($p->first_name.' '.$p->last_name) : $user->name;
                    $age = $p?->age ?? '--';
                    $height = $p?->height_feet ? $p->height_feet."' ".$p->height_inch."\"" : "--";
                    $location = $p?->city ?? 'Location not set';
                    $religion = $p?->religion ?? '--';
                    $profession = $p?->occupation ?? '--';
                @endphp

                <div id="view-profile" class="tab-pane active">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.2rem;">My Profile</h2>
                        <button class="btn-action-outline btn-sm" onclick="switchTab('edit-profile', document.querySelectorAll('.sidebar-link')[1])">
                            <i class="bi bi-pencil"></i> Inline Edit
                        </button>
                    </div>

                    <div class="detail-hero-card">
                        <div class="detail-info">
                            @if($p && $p->is_verified)
                                <div class="detail-badge-id"><i class="bi bi-patch-check-fill text-success me-1"></i> Verified Profile</div>
                            @else
                                <div class="detail-badge-id text-muted"><i class="bi bi-hourglass-split me-1"></i> Profile Pending</div>
                            @endif
                            <h1 class="detail-name">{{ $name }}</h1>
                            <div class="detail-stats">
                                <span><i class="bi bi-calendar"></i> {{ $age }} Years</span>
                                <span><i class="bi bi-arrows-vertical"></i> {{ $height }}</span>
                                <span><i class="bi bi-moon-stars"></i> {{ $religion }}</span>
                                <span><i class="bi bi-geo-alt"></i> {{ $location }}</span>
                            </div>
                            <p class="detail-bio mt-3 text-secondary" style="font-style: italic;">"{{ $p?->about_myself ?? 'Write a little about yourself so your matches can get to know you better!' }}"</p>
                        </div>
                    </div>

                    <h3 class="section-title"><i class="bi bi-person text-pink"></i> Basic Info</h3>
                    <div class="data-grid">
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-gender-ambiguous"></i> Gender</div><div class="data-value">{{ ucfirst($p?->gender ?? '--') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-people"></i> Marital Status</div><div class="data-value">{{ ucfirst($p?->marital_status ?? '--') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-calendar-event"></i> Date of Birth</div><div class="data-value">{{ $p?->dob ? \Carbon\Carbon::parse($p->dob)->format('d M Y') : '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-translate"></i> Mother Tongue</div><div class="data-value">{{ $p?->mother_tongue ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-cup-hot"></i> Diet</div><div class="data-value">{{ ucfirst($p?->diet ?? '--') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-droplet"></i> Blood Group</div><div class="data-value">{{ $p?->blood_group ?? '--' }}</div></div>
                    </div>

                    <h3 class="section-title mt-4"><i class="bi bi-bank2 text-pink"></i> Religious Background</h3>
                    <div class="data-grid">
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-moon-stars"></i> Religion</div><div class="data-value">{{ $p?->religion ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-diagram-3"></i> Caste</div><div class="data-value">{{ $p?->caste ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-bezier2"></i> Gotra</div><div class="data-value">{{ $p?->gotra ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-exclamation-triangle"></i> Mangal Dosh</div><div class="data-value">{{ ucfirst($p?->mangal_dosh ?? '--') }}</div></div>
                    </div>

                    <h3 class="section-title mt-4"><i class="bi bi-mortarboard text-pink"></i> Education & Profession</h3>
                    <div class="data-grid">
                        <div class="data-item" style="grid-column: span 2;"><div class="data-item-header"><i class="bi bi-book"></i> Highest Education</div><div class="data-value">{{ $p?->highest_qualification ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-briefcase"></i> Occupation</div><div class="data-value">{{ $profession }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-building"></i> Company / Business</div><div class="data-value">{{ $p?->company_name ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-cash-coin"></i> Annual Income</div><div class="data-value" style="color: #e75480;">{{ $p?->annual_income ? '₹'.$p->annual_income : '--' }}</div></div>
                    </div>

                    <h3 class="section-title mt-4"><i class="bi bi-house-door text-pink"></i> Family Details</h3>
                    <div class="data-grid">
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-people-fill"></i> Family Type</div><div class="data-value">{{ ucfirst($p?->family_type ?? '--') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-graph-up"></i> Family Status</div><div class="data-value">{{ ucfirst($p?->family_status ?? '--') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-person-workspace"></i> Father's Occupation</div><div class="data-value">{{ $p?->father_occupation ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-person-hearts"></i> Mother's Occupation</div><div class="data-value">{{ $p?->mother_occupation ?? '--' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-person-standing"></i> No. of Brothers</div><div class="data-value">{{ $p?->no_of_brothers ?? '0' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-person-standing-dress"></i> No. of Sisters</div><div class="data-value">{{ $p?->no_of_sisters ?? '0' }}</div></div>
                    </div>

                    <h3 class="section-title mt-4"><i class="bi bi-heart text-pink"></i> Partner Preferences</h3>
                    <div class="data-grid" style="background: rgba(231, 84, 128, 0.03); border-color: rgba(231, 84, 128, 0.1);">
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-calendar2-range"></i> Age Range</div><div class="data-value">{{ $p?->partner_min_age ?? '--' }} to {{ $p?->partner_max_age ?? '--' }} yrs</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-rulers"></i> Height Range</div><div class="data-value">{{ $p?->partner_min_height ?? '--' }} to {{ $p?->partner_max_height ?? '--' }} cm</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-people"></i> Marital Status</div><div class="data-value">{{ ucfirst($p?->partner_marital_status ?? 'Any') }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-moon-stars"></i> Religion</div><div class="data-value">{{ $p?->partner_religion ?? 'Any' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-diagram-3"></i> Caste</div><div class="data-value">{{ $p?->partner_caste ?? 'Any' }}</div></div>
                        <div class="data-item"><div class="data-item-header"><i class="bi bi-book"></i> Education</div><div class="data-value">{{ $p?->partner_education ?? 'Any' }}</div></div>
                        <div class="data-item" style="grid-column: span 2;"><div class="data-item-header"><i class="bi bi-geo-alt"></i> Location Preference</div><div class="data-value">{{ is_array($p?->area_preference) ? implode(', ', $p->area_preference) : ($p?->area_preference ?? 'Any') }}</div></div>
                    </div>
                </div>

                <div id="edit-profile" class="tab-pane">
                    <div class="mb-4 border-bottom pb-3">
                        <h2 class="font-serif fw-bold m-0 text-dark" style="font-size: 2.2rem;">Edit Profile #{{ $p?->id ?? 'New' }}</h2>
                        <p class="text-muted mt-2">Update your complete information inline.</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-4">
                            
                            <div class="col-md-6">
                                <label class="premium-label">First Name</label>
                                <input type="text" name="first_name" class="premium-input" value="{{ $p?->first_name ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Last Name</label>
                                <input type="text" name="last_name" class="premium-input" value="{{ $p?->last_name ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="premium-label">About Me (Bio)</label>
                                <textarea name="about_myself" class="premium-input" rows="3">{{ $p?->about_myself ?? '' }}</textarea>
                            </div>

                            <div class="col-12"><h4 class="form-section-title"><i class="bi bi-person text-pink me-2"></i> Basic Info</h4></div>
                            
                            <div class="col-md-4">
                                <label class="premium-label">Gender</label>
                                <select name="gender" class="premium-input">
                                    <option value="Male" {{ $p?->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $p?->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Marital Status</label>
                                <select name="marital_status" class="premium-input">
                                    <option value="Single" {{ $p?->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ $p?->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Divorced" {{ $p?->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="Widowed" {{ $p?->marital_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Date of Birth</label>
                                <input type="date" name="dob" class="premium-input" value="{{ $p?->dob ? \Carbon\Carbon::parse($p->dob)->format('Y-m-d') : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Mother Tongue</label>
                                <input type="text" name="mother_tongue" class="premium-input" value="{{ $p?->mother_tongue ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Diet</label>
                                <select name="diet" class="premium-input">
                                    <option value="Vegetarian" {{ $p?->diet == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                                    <option value="Non-Vegetarian" {{ $p?->diet == 'Non-Vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                                    <option value="Eggetarian" {{ $p?->diet == 'Eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Blood Group</label>
                                <input type="text" name="blood_group" class="premium-input" value="{{ $p?->blood_group ?? '' }}">
                            </div>

                            <div class="col-12"><h4 class="form-section-title"><i class="bi bi-bank2 text-pink me-2"></i> Religious Background</h4></div>
                            
                            <div class="col-md-3">
                                <label class="premium-label">Religion</label>
                                <input type="text" name="religion" class="premium-input" value="{{ $p?->religion ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Caste</label>
                                <input type="text" name="caste" class="premium-input" value="{{ $p?->caste ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Gotra</label>
                                <input type="text" name="gotra" class="premium-input" value="{{ $p?->gotra ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Mangal Dosh</label>
                                <select name="mangal_dosh" class="premium-input">
                                    <option value="No" {{ $p?->mangal_dosh == 'No' ? 'selected' : '' }}>No</option>
                                    <option value="Yes" {{ $p?->mangal_dosh == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="Don't Know" {{ $p?->mangal_dosh == "Don't Know" ? 'selected' : '' }}>Don't Know</option>
                                </select>
                            </div>

                            <div class="col-12"><h4 class="form-section-title"><i class="bi bi-mortarboard text-pink me-2"></i> Education & Profession</h4></div>
                            
                            <div class="col-md-6">
                                <label class="premium-label">Highest Education</label>
                                <input type="text" name="highest_qualification" class="premium-input" value="{{ $p?->highest_qualification ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Occupation</label>
                                <input type="text" name="occupation" class="premium-input" value="{{ $p?->occupation ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Company / Business</label>
                                <input type="text" name="company_name" class="premium-input" value="{{ $p?->company_name ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Annual Income</label>
                                <input type="text" name="annual_income" class="premium-input" value="{{ $p?->annual_income ?? '' }}" placeholder="e.g. 10 Lakhs">
                            </div>

                            <div class="col-12"><h4 class="form-section-title"><i class="bi bi-house-door text-pink me-2"></i> Family Details</h4></div>
                            
                            <div class="col-md-6">
                                <label class="premium-label">Family Type</label>
                                <select name="family_type" class="premium-input">
                                    <option value="Nuclear" {{ $p?->family_type == 'Nuclear' ? 'selected' : '' }}>Nuclear</option>
                                    <option value="Joint" {{ $p?->family_type == 'Joint' ? 'selected' : '' }}>Joint</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Family Status</label>
                                <select name="family_status" class="premium-input">
                                    <option value="Middle Class" {{ $p?->family_status == 'Middle Class' ? 'selected' : '' }}>Middle Class</option>
                                    <option value="Upper Middle Class" {{ $p?->family_status == 'Upper Middle Class' ? 'selected' : '' }}>Upper Middle Class</option>
                                    <option value="Rich / Affluent" {{ $p?->family_status == 'Rich / Affluent' ? 'selected' : '' }}>Rich / Affluent</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Father's Occupation</label>
                                <input type="text" name="father_occupation" class="premium-input" value="{{ $p?->father_occupation ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Mother's Occupation</label>
                                <input type="text" name="mother_occupation" class="premium-input" value="{{ $p?->mother_occupation ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">No. of Brothers</label>
                                <input type="number" name="no_of_brothers" class="premium-input" value="{{ $p?->no_of_brothers ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">No. of Sisters</label>
                                <input type="number" name="no_of_sisters" class="premium-input" value="{{ $p?->no_of_sisters ?? '' }}">
                            </div>

                            <div class="col-12"><h4 class="form-section-title"><i class="bi bi-heart text-pink me-2"></i> Partner Preferences</h4></div>
                            
                            <div class="col-md-3">
                                <label class="premium-label">Min Age</label>
                                <input type="number" name="partner_min_age" class="premium-input" value="{{ $p?->partner_min_age ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Max Age</label>
                                <input type="number" name="partner_max_age" class="premium-input" value="{{ $p?->partner_max_age ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Min Height (cm)</label>
                                <input type="number" name="partner_min_height" class="premium-input" value="{{ $p?->partner_min_height ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label class="premium-label">Max Height (cm)</label>
                                <input type="number" name="partner_max_height" class="premium-input" value="{{ $p?->partner_max_height ?? '' }}">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="premium-label">Marital Status</label>
                                <input type="text" name="partner_marital_status" class="premium-input" value="{{ $p?->partner_marital_status ?? '' }}" placeholder="e.g. Single, Divorced">
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Religion</label>
                                <input type="text" name="partner_religion" class="premium-input" value="{{ $p?->partner_religion ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="premium-label">Caste</label>
                                <input type="text" name="partner_caste" class="premium-input" value="{{ $p?->partner_caste ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Education</label>
                                <input type="text" name="partner_education" class="premium-input" value="{{ $p?->partner_education ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="premium-label">Location / Area Preference</label>
                                <input type="text" name="area_preference" class="premium-input" value="{{ is_array($p?->area_preference) ? implode(', ', $p->area_preference) : ($p?->area_preference ?? '') }}" placeholder="e.g. Delhi, Mumbai">
                            </div>

                            <div class="col-12 mt-5 pt-3 border-top text-end">
                                <button type="button" class="btn-action-outline me-3" onclick="switchTab('view-profile', document.querySelectorAll('.sidebar-link')[0])">Discard Changes</button>
                                <button type="submit" class="btn-action-solid"><i class="bi bi-save me-1"></i> Save Profile Updates</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="my-matches" class="tab-pane">
                    <div class="mb-4">
                        <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.2rem;">Your Perfect Matches</h2>
                        <p class="text-muted mt-2">Profiles curated specifically based on your preferences.</p>
                    </div>

                    <div class="matches-grid mt-4">
                        @php
                            $stockImages = [
                                'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop',
                                'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&h=500&fit=crop',
                                'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=500&fit=crop',
                                'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?w=400&h=500&fit=crop'
                            ];
                        @endphp
                        
                        @for($i = 0; $i < 4; $i++)
                            <div class="match-card">
                                <img src="{{ $stockImages[$i] }}" class="match-img" alt="Match">
                                <div class="match-info">
                                    <h5 class="match-name">Candidate Name</h5>
                                    <p class="match-details">{{ rand(25,30) }} yrs, 5'{{ rand(4,8) }}"<br>Software Engineer</p>
                                    <span class="match-badge"><i class="bi bi-stars"></i> {{ rand(85, 98) }}% Match</span>
                                </div>
                                <div class="mt-2 border-top pt-3 d-flex justify-content-center gap-2 px-3">
                                    <button class="btn btn-sm btn-light rounded-circle" style="width: 40px; height: 40px;"><i class="bi bi-x-lg text-secondary"></i></button>
                                    <button class="btn btn-sm text-white rounded-pill px-4 flex-grow-1" style="background: linear-gradient(90deg, #e75480, #ff7eb3); border: none;"><i class="bi bi-heart-fill me-1"></i> Connect</button>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchTab(tabId, clickedElement) {
        document.querySelectorAll('.tab-pane').forEach(function(pane) {
            pane.classList.remove('active');
        });
        
        document.querySelectorAll('.sidebar-link').forEach(function(link) {
            link.classList.remove('active');
        });

        document.getElementById(tabId).classList.add('active');
        clickedElement.classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
@endpush