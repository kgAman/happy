@extends('layouts.master')

{{-- Fallback logic --}}
@php
    if (empty($profile->first_name)) {
        $displayProfile = [
            'id' => 1,
            'profile_id' => 'HW-10048',
            'name' => 'Priya Sharma',
            'age' => 26,
            'height' => "5'4\" (162 cm)",
            'religion' => 'Hindu',
            'caste' => 'Brahmin',
            'sub_caste' => 'Saryupareen',
            'mother_tongue' => 'Hindi',
            'location' => 'Mumbai, Maharashtra',
            'highest_qualification' => 'B.Tech from IIT Bombay',
            'profession' => 'Software Engineer',
            'company' => 'Tech Corp',
            'income' => '₹ 15,00,000',
            'marital_status' => 'Never Married',
            'diet' => 'Vegetarian',
            'blood_group' => 'O+',
            'about' => 'I am a lively, career-oriented person who loves to balance work and family life. I enjoy traveling, reading fiction, and exploring new cuisines. I am looking for someone who is understanding, supportive, and values family traditions.',
            'verified' => true,
            'premium' => true,
            'online' => true,
            'is_shortlisted' => false,
            'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&h=800&fit=crop',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&h=800&fit=crop',
            'gender' => 'Female',
            'dob' => '14 May 1998',
            'mangal_dosh' => 'No',
            'gotra' => 'Kashyap',
            'rashi' => 'Leo',
            'nakshatra' => 'Magha',
            'family_type' => 'Nuclear',
            'family_status' => 'Upper Middle Class',
            'father_occupation' => 'Business',
            'mother_occupation' => 'Homemaker',
            'brothers' => '1',
            'sisters' => '0',
            'partner_age' => '26 - 30 Years',
            'partner_height' => '165 - 180 cm',
            'partner_marital_status' => 'Never Married',
            'partner_religion' => 'Hindu / Brahmin',
            'partner_education' => 'Bachelors or Masters',
            'partner_location' => 'Mumbai, Pune, Bangalore'
        ];
    } else {
        $displayProfile = [
            'id' => $profile->id,
            'profile_id' => 'HW-'.$profile->id,
            'name' => trim($profile->first_name.' '.$profile->last_name),
            'age' => $profile->age,
            'height' => $profile->height_feet ? $profile->height_feet."' ".$profile->height_inch."\"" : '—',
            'religion' => $profile->religion ?? '—',
            'caste' => $profile->caste ?? '—',
            'sub_caste' => $profile->sub_caste ?? '',
            'mother_tongue' => $profile->mother_tongue ?? '—',
            'location' => $profile->city ?? '—',
            'highest_qualification' => $profile->highest_qualification ?? '—',
            'profession' => $profile->occupation ?? '—',
            'company' => $profile->company_name ?? '—',
            'income' => $profile->annual_income ? '₹ '.$profile->annual_income : '—',
            'marital_status' => $profile->marital_status ?? '—',
            'diet' => $profile->diet ?? '—',
            'blood_group' => $profile->blood_group ?? '—',
            'about' => $profile->about_myself ?? 'No bio provided yet.',
            'verified' => $profile->is_verified ?? false,
            'premium' => $profile->is_premium ?? false,
            'online' => false,
            'is_shortlisted' => $profile->is_shortlisted ?? false,
            'image' => $profile->profile_photo ? asset('storage/'.$profile->profile_photo) : null,
            'profile_photo_url' => $profile->profile_photo_url,
            'gender' => ucfirst($profile->gender ?? '—'),
            'dob' => $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('d M Y') : '—',
            'mangal_dosh' => ucfirst($profile->mangal_dosh ?? '—'),
            'gotra' => $profile->gotra ?? '—',
            'rashi' => $profile->rashi ?? '—',
            'nakshatra' => $profile->nakshatra ?? '—',
            'family_type' => $profile->family_type ?? '—',
            'family_status' => $profile->family_status ?? '—',
            'father_occupation' => $profile->father_occupation ?? '—',
            'mother_occupation' => $profile->mother_occupation ?? '—',
            'brothers' => $profile->no_of_brothers ?? 0,
            'sisters' => $profile->no_of_sisters ?? 0,
            'partner_age' => ($profile->partner_min_age ?? '?').' - '.($profile->partner_max_age ?? '?').' Years',
            'partner_height' => ($profile->partner_min_height ?? '?').' - '.($profile->partner_max_height ?? '?').' cm',
            'partner_marital_status' => $profile->partner_marital_status ?? 'Doesn\'t Matter',
            'partner_religion' => ($profile->partner_religion ?? 'Any').' / '.($profile->partner_caste ?? 'Any'),
            'partner_education' => $profile->partner_education ?? 'Doesn\'t Matter',
            'partner_location' => is_array($profile->area_preference) ? implode(', ', $profile->area_preference) : ($profile->area_preference ?? 'Doesn\'t Matter')
        ];
    }
@endphp

@section('title', $displayProfile['name'] . ' | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --brand-pink: #e75480;
        --brand-pink-light: #fdf2f5;
        --brand-pink-hover: #d6406c;
        --text-dark: #2d1b2e;
        --text-muted: #6b5b6b;
        --bg-color: #faf7f8; /* Soft romantic background */
        --border-color: rgba(231, 84, 128, 0.15);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-dark);
        position: relative;
        overflow-x: hidden;
    }

    .font-playfair { font-family: 'Playfair Display', serif; }

    /* --- FLOATING BACKGROUND HEARTS (SVG) --- */
    .bg-hearts-container {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }

    .floating-heart {
        position: absolute;
        fill: var(--brand-pink);
        opacity: 0.04;
        animation: floatHeart var(--duration) ease-in-out infinite alternate;
    }

    .fh-1 { top: 15%; left: 5%; width: 120px; --duration: 8s; transform: rotate(-15deg); }
    .fh-2 { top: 40%; right: 5%; width: 180px; --duration: 12s; transform: rotate(20deg); }
    .fh-3 { bottom: 10%; left: 15%; width: 90px; --duration: 9s; transform: rotate(10deg); }
    .fh-4 { bottom: 30%; right: 20%; width: 140px; --duration: 15s; transform: rotate(-25deg); opacity: 0.02; }
    .fh-5 { top: 5%; right: 30%; width: 70px; --duration: 7s; transform: rotate(45deg); opacity: 0.05; }

    @keyframes floatHeart {
        0% { transform: translateY(0) scale(1) rotate(0deg); }
        100% { transform: translateY(-40px) scale(1.05) rotate(10deg); }
    }

    /* --- PAGE HEADER BACKGROUND --- */
    .profile-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #2a1625 0%, #e75480 150%);
        z-index: 0;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        box-shadow: 0 10px 30px rgba(231,84,128,0.2);
    }

    .profile-header-bg::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M22.95 24.5C21.84 22.9 20.3 22 18.5 22c-2.48 0-4.5 2.02-4.5 4.5 0 3.32 4.13 6.94 8.7 10.15 4.57-3.21 8.7-6.83 8.7-10.15 0-2.48-2.02-4.5-4.5-4.5-1.8 0-3.34.9-4.45 2.5zM52.95 54.5C51.84 52.9 50.3 52 48.5 52c-2.48 0-4.5 2.02-4.5 4.5 0 3.32 4.13 6.94 8.7 10.15 4.57-3.21 8.7-6.83 8.7-10.15 0-2.48-2.02-4.5-4.5-4.5-1.8 0-3.34.9-4.45 2.5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .profile-container {
        position: relative;
        z-index: 10;
        padding-top: 130px;
        padding-bottom: 80px;
        max-width: 1100px;
    }

    /* --- BACK BUTTON --- */
    .btn-back-nav {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.9);
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        margin-bottom: 25px;
        transition: all 0.3s;
        background: rgba(255,255,255,0.1);
        padding: 8px 16px;
        border-radius: 50px;
        backdrop-filter: blur(5px);
    }
    .btn-back-nav:hover {
        color: #ffffff;
        background: rgba(255,255,255,0.2);
        transform: translateX(-5px);
    }

    /* --- HERO SECTION --- */
    .hero-card {
        background: linear-gradient(145deg, #ffffff 0%, #fff5f8 100%);
        border-radius: 30px;
        box-shadow: 0 25px 50px rgba(231, 84, 128, 0.12);
        padding: 45px;
        margin-bottom: 40px;
        border: 1px solid rgba(255,255,255,0.8);
        position: relative;
        overflow: hidden;
    }

    /* Card Watermark */
    .hero-card::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 300px; height: 300px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e75480' opacity='0.03'%3E%3Cpath d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: contain;
        z-index: 0;
        pointer-events: none;
    }

    .hero-image-wrapper {
        position: relative;
        width: 100%;
        max-width: 340px;
        aspect-ratio: 3/4;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(231, 84, 128, 0.25);
        margin: 0 auto;
        border: 6px solid #ffffff;
        z-index: 2;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-details {
        padding-left: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        position: relative;
        z-index: 2;
    }

    .hero-name {
        font-size: clamp(2.8rem, 4vw, 4rem);
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
        line-height: 1.1;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.02);
    }

    .hero-meta {
        font-size: 1.15rem;
        color: var(--text-muted);
        margin-bottom: 25px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
        font-weight: 500;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        padding: 6px 14px;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    .meta-item i { color: var(--brand-pink); font-size: 1.2rem; }

    .hero-badges {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
    }
    .badge-custom {
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    }
    .badge-id { background: #ffffff; color: var(--text-muted); }
    .badge-verified { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; }

    /* --- ACTION BUTTONS --- */
    .action-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .btn-action-primary {
        background: linear-gradient(135deg, var(--brand-pink) 0%, #ff7eb3 100%);
        color: white;
        border: none;
        padding: 16px 36px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 10px 25px rgba(231, 84, 128, 0.4);
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    .btn-action-primary:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.5);
        color: white;
    }

    .btn-action-secondary {
        background: #ffffff;
        color: var(--brand-pink);
        border: 2px solid transparent; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    .btn-action-secondary:hover {
        background: var(--brand-pink-light);
        color: var(--brand-pink-hover);
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.15);
    }
    
    .btn-action-secondary.active {
        background: linear-gradient(135deg, #d4af37 0%, #f1c40f 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
    }

    /* --- ACCORDION DETAILS SECTION --- */
    .details-container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
    }

    .custom-accordion .accordion-item {
        background: linear-gradient(145deg, #ffffff 0%, #fcf9fa 100%);
        border: 1px solid #ffffff;
        border-radius: 24px !important;
        margin-bottom: 25px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        position: relative;
    }

    /* Accordion Watermarks */
    .custom-accordion .accordion-item::before {
        content: '';
        position: absolute;
        bottom: -20px; right: 10px;
        width: 150px; height: 150px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e75480' opacity='0.02'%3E%3Cpath d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        z-index: 0;
        pointer-events: none;
    }

    .custom-accordion .accordion-button {
        padding: 28px 35px;
        background: transparent;
        color: var(--text-dark);
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: none;
        border: none;
        z-index: 2;
        position: relative;
    }

    .custom-accordion .accordion-button:not(.collapsed) {
        color: var(--brand-pink);
        background: transparent;
        border-bottom: 1px solid var(--border-color);
    }

    .custom-accordion .accordion-button::after {
        filter: invert(41%) sepia(50%) saturate(836%) hue-rotate(301deg) brightness(97%) contrast(93%);
        transform: scale(1.2);
    }

    .custom-accordion .accordion-body {
        padding: 35px;
        background: transparent;
        z-index: 2;
        position: relative;
    }

    /* Upgraded Data Grids */
    .data-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 35px 25px;
    }

    .data-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        background: rgba(255,255,255,0.6);
        padding: 15px;
        border-radius: 16px;
        border: 1px solid rgba(231,84,128,0.05);
        transition: all 0.3s;
    }

    .data-item:hover {
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(231,84,128,0.08);
        transform: translateY(-2px);
    }

    .data-icon {
        width: 40px; height: 40px;
        background: var(--brand-pink-light);
        color: var(--brand-pink);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .data-text-col {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .data-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        font-weight: 700;
    }

    .data-value {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    @media (max-width: 991px) {
        .hero-card { padding: 30px 20px; text-align: center; }
        .hero-details { padding-left: 0; margin-top: 30px; align-items: center; }
        .hero-meta { justify-content: center; }
        .action-row { justify-content: center; }
        .custom-accordion .accordion-button { padding: 20px; font-size: 1.3rem; }
        .custom-accordion .accordion-body { padding: 20px; }
        .data-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .data-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="bg-hearts-container">
    <svg class="floating-heart fh-1" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
    <svg class="floating-heart fh-2" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
    <svg class="floating-heart fh-3" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
    <svg class="floating-heart fh-4" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
    <svg class="floating-heart fh-5" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
</div>

<div class="profile-header-bg"></div>

<div class="container profile-container">
    
    <a href="javascript:history.back()" class="btn-back-nav">
        <i class="bi bi-arrow-left"></i> Back to Search Results
    </a>

    <div class="hero-card">
        <div class="row align-items-center">
            
            <div class="col-lg-4">
                <div class="hero-image-wrapper">
                    @if($displayProfile['profile_photo_url'])
                        <img src="{{ $displayProfile['profile_photo_url'] }}" class="hero-image" alt="Profile Photo">
                    @else
                        <div class="hero-image d-flex align-items-center justify-content-center" style="background: var(--brand-pink-light); color: var(--brand-pink); font-size: 6rem; font-family: 'Playfair Display', serif;">
                            {{ strtoupper(substr($displayProfile['name'], 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-8">
                <div class="hero-details">
                    
                    <div class="hero-badges">
                        <span class="badge-custom badge-id"><i class="bi bi-person-badge"></i> {{ $displayProfile['profile_id'] }}</span>
                        @if($displayProfile['verified'])
                            <span class="badge-custom badge-verified"><i class="bi bi-shield-check"></i> Verified Profile</span>
                        @endif
                    </div>

                    <h1 class="hero-name font-playfair">{{ $displayProfile['name'] }}</h1>
                    
                    <div class="hero-meta">
                        <div class="meta-item"><i class="bi bi-calendar-event"></i> {{ $displayProfile['age'] }} Years</div>
                        <div class="meta-item"><i class="bi bi-arrows-vertical"></i> {{ $displayProfile['height'] }}</div>
                        <div class="meta-item"><i class="bi bi-moon-stars"></i> {{ $displayProfile['religion'] }}</div>
                        <div class="meta-item"><i class="bi bi-geo-alt"></i> {{ $displayProfile['location'] }}</div>
                    </div>

                    <p class="text-muted mb-4 fs-6" style="max-width: 650px; line-height: 1.7;">
                        "{{ $displayProfile['about'] }}"
                    </p>

                    <div class="action-row">
                        <button class="btn-action-primary">
                            <i class="bi bi-heart-fill"></i> Send Interest
                        </button>
                        
                        @auth
                            <a href="{{ url('/messages/chat/' . $displayProfile['id']) }}" class="btn-action-secondary">
                                <i class="bi bi-chat-dots-fill"></i> Message
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-action-secondary" onclick="alert('Please log in or register to send a message to {{ $displayProfile['name'] }}.');">
                                <i class="bi bi-chat-dots-fill"></i> Message
                            </a>
                        @endauth

                        <button class="btn-action-secondary btn-shortlist {{ $displayProfile['is_shortlisted'] ? 'active' : '' }}" onclick="toggleShortlist({{ $displayProfile['id'] }}, this)">
                            <i class="bi {{ $displayProfile['is_shortlisted'] ? 'bi-star-fill' : 'bi-star' }}"></i> 
                            <span class="shortlist-text">{{ $displayProfile['is_shortlisted'] ? 'Shortlisted' : 'Shortlist' }}</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="details-container">
        <div class="accordion custom-accordion" id="profileAccordion">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingBasic">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic">
                        Basic Information
                    </button>
                </h2>
                <div id="collapseBasic" class="accordion-collapse collapse show" aria-labelledby="headingBasic" data-bs-parent="#profileAccordion">
                    <div class="accordion-body">
                        <div class="data-grid">
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-gender-ambiguous"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Gender</span>
                                    <span class="data-value">{{ $displayProfile['gender'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-people"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Marital Status</span>
                                    <span class="data-value">{{ $displayProfile['marital_status'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-calendar-heart"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Date of Birth</span>
                                    <span class="data-value">{{ $displayProfile['dob'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-translate"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Mother Tongue</span>
                                    <span class="data-value">{{ $displayProfile['mother_tongue'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-cup-hot"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Diet</span>
                                    <span class="data-value">{{ $displayProfile['diet'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-droplet"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Blood Group</span>
                                    <span class="data-value">{{ $displayProfile['blood_group'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAstro">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAstro" aria-expanded="false" aria-controls="collapseAstro">
                        Religious & Astrological Background
                    </button>
                </h2>
                <div id="collapseAstro" class="accordion-collapse collapse" aria-labelledby="headingAstro" data-bs-parent="#profileAccordion">
                    <div class="accordion-body">
                        <div class="data-grid">
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-book"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Religion</span>
                                    <span class="data-value">{{ $displayProfile['religion'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-diagram-3"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Caste / Sub-Caste</span>
                                    <span class="data-value">{{ $displayProfile['caste'] }} {{ $displayProfile['sub_caste'] ? '('.$displayProfile['sub_caste'].')' : '' }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-bezier2"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Gotra</span>
                                    <span class="data-value">{{ $displayProfile['gotra'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-exclamation-triangle"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Mangal Dosh</span>
                                    <span class="data-value">{{ $displayProfile['mangal_dosh'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-moon-stars"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Rashi</span>
                                    <span class="data-value">{{ $displayProfile['rashi'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-star"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Nakshatra</span>
                                    <span class="data-value">{{ $displayProfile['nakshatra'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEdu">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEdu" aria-expanded="false" aria-controls="collapseEdu">
                        Education & Profession
                    </button>
                </h2>
                <div id="collapseEdu" class="accordion-collapse collapse" aria-labelledby="headingEdu" data-bs-parent="#profileAccordion">
                    <div class="accordion-body">
                        <div class="data-grid">
                            <div class="data-item" style="grid-column: span 2;">
                                <div class="data-icon"><i class="bi bi-mortarboard"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Highest Education</span>
                                    <span class="data-value">{{ $displayProfile['highest_qualification'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-briefcase"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Occupation</span>
                                    <span class="data-value">{{ $displayProfile['profession'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-building"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Company / Business</span>
                                    <span class="data-value">{{ $displayProfile['company'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-cash-coin"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Annual Income</span>
                                    <span class="data-value" style="color: var(--brand-pink); font-weight: 700;">{{ $displayProfile['income'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFamily">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFamily" aria-expanded="false" aria-controls="collapseFamily">
                        Family Details
                    </button>
                </h2>
                <div id="collapseFamily" class="accordion-collapse collapse" aria-labelledby="headingFamily" data-bs-parent="#profileAccordion">
                    <div class="accordion-body">
                        <div class="data-grid">
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-house-door"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Family Type</span>
                                    <span class="data-value">{{ $displayProfile['family_type'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-graph-up-arrow"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Family Status</span>
                                    <span class="data-value">{{ $displayProfile['family_status'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-person-workspace"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Father's Occupation</span>
                                    <span class="data-value">{{ $displayProfile['father_occupation'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-person-hearts"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Mother's Occupation</span>
                                    <span class="data-value">{{ $displayProfile['mother_occupation'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-person-standing"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Brothers</span>
                                    <span class="data-value">{{ $displayProfile['brothers'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon"><i class="bi bi-person-standing-dress"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Sisters</span>
                                    <span class="data-value">{{ $displayProfile['sisters'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item" style="border: 2px solid rgba(231,84,128,0.2);">
                <h2 class="accordion-header" id="headingPref">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePref" aria-expanded="false" aria-controls="collapsePref">
                        Partner Preferences
                    </button>
                </h2>
                <div id="collapsePref" class="accordion-collapse collapse" aria-labelledby="headingPref" data-bs-parent="#profileAccordion">
                    <div class="accordion-body" style="background: var(--brand-pink-light);">
                        <div class="data-grid">
                            <div class="data-item">
                                <div class="data-icon bg-white"><i class="bi bi-calendar2-range"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Age Preference</span>
                                    <span class="data-value">{{ $displayProfile['partner_age'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon bg-white"><i class="bi bi-rulers"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Height Preference</span>
                                    <span class="data-value">{{ $displayProfile['partner_height'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon bg-white"><i class="bi bi-people"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Marital Status</span>
                                    <span class="data-value">{{ $displayProfile['partner_marital_status'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon bg-white"><i class="bi bi-book"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Religion / Caste</span>
                                    <span class="data-value">{{ $displayProfile['partner_religion'] }}</span>
                                </div>
                            </div>
                            <div class="data-item">
                                <div class="data-icon bg-white"><i class="bi bi-mortarboard"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Education</span>
                                    <span class="data-value">{{ $displayProfile['partner_education'] }}</span>
                                </div>
                            </div>
                            <div class="data-item" style="grid-column: span 2;">
                                <div class="data-icon bg-white"><i class="bi bi-geo-alt"></i></div>
                                <div class="data-text-col">
                                    <span class="data-label">Location Preference</span>
                                    <span class="data-value">{{ $displayProfile['partner_location'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleShortlist(profileId, button) {
        button.classList.toggle('active');
        let icon = button.querySelector('i');
        let textSpan = button.querySelector('.shortlist-text'); 
        
        if (icon.classList.contains('bi-star')) {
            icon.classList.remove('bi-star');
            icon.classList.add('bi-star-fill');
            if(textSpan) textSpan.innerText = 'Shortlisted';
        } else {
            icon.classList.remove('bi-star-fill');
            icon.classList.add('bi-star');
            if(textSpan) textSpan.innerText = 'Shortlist';
        }

        fetch(`/profiles/${profileId}/shortlist`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                if(response.status === 401) {
                    window.location.href = '/login';
                    throw new Error('Unauthorized');
                }
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            if(error.message !== 'Unauthorized') {
                button.classList.toggle('active');
                icon.classList.toggle('bi-star');
                icon.classList.toggle('bi-star-fill');
                if(textSpan) textSpan.innerText = icon.classList.contains('bi-star') ? 'Shortlist' : 'Shortlisted';
                console.log("Shortlist triggered!");
            }
        });
    }
</script>
@endpush