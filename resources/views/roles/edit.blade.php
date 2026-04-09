@extends('layouts.admin')
@section('title', 'Edit Role - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography & Spacing */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
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

    /* Premium Form Card */
    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    /* Premium Input Styling */
    .premium-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: block;
    }

    .premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.8rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
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

    /* Permission Toggle Cards */
    .perm-card {
        background: #ffffff;
        border: 2px solid #f1f5f9;
        border-radius: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .perm-card:hover {
        border-color: rgba(231, 84, 128, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.03);
    }

    /* Custom Form Switch (Bootstrap Override) */
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.25em;
        cursor: pointer;
        border-color: #cbd5e1;
    }
    
    .form-switch .form-check-input:checked {
        background-color: #e75480;
        border-color: #e75480;
    }

    .form-switch .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(231, 84, 128, 0.25);
    }

    /* Glowing Premium Buttons */
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.8rem 2rem;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        border: none;
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
        border-radius: 14px;
        padding: 0.8rem 1.8rem;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s ease;
    }

    .btn-premium-outline:hover {
        border-color: #111111;
        color: #111111;
        background: #f8fafc;
        transform: translateY(-2px);
    }

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


<div class="container-fluid py-5 page-spacing font-sans">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Edit Role</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Update the permissions and capabilities of this administrative role.</p>
        </div>
    </div>

    <div class="premium-card p-4 p-lg-5 animate-card delay-1">
        
        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
            <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white bg-gradient-signature" style="width: 48px; height: 48px; font-size: 1.2rem;">
                <i class="bi bi-pencil-square"></i>
            </div>
            <h4 class="font-serif fw-bold mb-0 text-dark">Role Configuration</h4>
        </div>

        {{-- Error Block --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4 border-0 shadow-sm" style="background: rgba(254, 242, 242, 0.9); color: #ef4444; border-radius: 12px; border-left: 4px solid #ef4444;">
                <ul class="mb-0 fw-medium ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            {{-- Role Name --}}
            <div class="mb-5">
                <label class="premium-label">Role Identifier Name</label>
                <div class="position-relative">
                    <i class="bi bi-fonts position-absolute text-muted fs-5" style="left: 15px; top: 12px;"></i>
                    <input type="text" name="name" class="form-control premium-input w-100" style="padding-left: 45px;" value="{{ $role->name }}" placeholder="e.g. Super Admin, Moderator, Editor" required>
                </div>
            </div>

            {{-- Permissions Grid --}}
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="premium-label mb-0">System Permissions</label>
                    <small class="text-muted fw-semibold">Toggle the switches to update access levels.</small>
                </div>
                
                <div class="row g-3">
                    @foreach($permissions as $perm)
                        <div class="col-md-4 col-lg-3">
                            <label class="perm-card d-block p-3 m-0 shadow-sm w-100 h-100" for="perm_{{ $perm->id }}">
                                <div class="d-flex justify-content-between align-items-center h-100">
                                    <span class="fw-bold text-dark text-capitalize" style="font-size: 0.9rem;">
                                        {{ str_replace('-', ' ', $perm->name) }}
                                    </span>
                                    <div class="form-check form-switch m-0 p-0 d-flex align-items-center">
                                        <input class="form-check-input m-0"
                                               type="checkbox"
                                               name="permissions[]"
                                               value="{{ $perm->name }}"
                                               id="perm_{{ $perm->id }}"
                                               {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 pt-4 border-top">
                <a href="{{ route('admin.roles.index') }}" class="btn-premium-outline text-center text-decoration-none order-2 order-sm-1">
                    <i class="bi bi-arrow-left me-2"></i> Cancel
                </a>

                <button type="submit" class="btn-glow order-1 order-sm-2">
                    Update Role <i class="bi bi-check2-circle ms-2"></i>
                </button>
            </div>

        </form>

    </div>

</div>
@endsection