@extends('layouts.admin')
@section('title', 'Permissions Management - HappilyWeds')

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
    .delay-2 { animation-delay: 0.2s; }

    /* Glowing Premium Buttons */
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.8rem 1.8rem;
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

    /* Permission Group Header */
    .perm-group-header {
        background: transparent;
        border-bottom: 2px solid rgba(231, 84, 128, 0.15);
        padding-bottom: 0.8rem;
        margin-bottom: 1.5rem;
        margin-top: 3rem;
        display: flex;
        align-items: center;
    }

    .perm-group-badge {
        background: rgba(231, 84, 128, 0.1);
        color: #e75480;
        border: 1px solid rgba(231, 84, 128, 0.2);
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    /* Floating Permission Item Row */
    .perm-item-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        padding: 1rem 1.5rem;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .perm-item-card:hover {
        transform: scale(1.01) translateY(-2px);
        background: #ffffff;
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.08);
        border-left: 4px solid #e75480;
    }

    /* Soft Action Icons */
    .action-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        font-size: 1.1rem;
    }

    .action-icon-btn.delete:hover { 
        background: #ef4444; 
        color: white; 
        transform: translateY(-2px); 
        box-shadow: 0 6px 12px rgba(239, 68, 68, 0.25); 
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

<div class="container py-5 page-spacing font-sans" style="max-width: 900px;">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">System Permissions</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage the foundational access rights available to system roles.</p>
        </div>

        <a href="{{ route('admin.permissions.create') }}" class="btn-glow shadow-sm d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-shield-plus me-2 border border-white rounded-circle d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; font-size: 0.8rem;"></i> 
            Add Permission
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card delay-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="animate-card delay-2 pb-5">
        
        @forelse($permissions as $type => $group)
            
            {{-- Type Group Header --}}
            <div class="perm-group-header">
                <div class="perm-group-badge d-inline-flex align-items-center">
                    <i class="bi bi-tag-fill me-2"></i> {{ $type ?? 'General Capabilities' }}
                </div>
            </div>

            {{-- Permission Rows --}}
            <div class="row">
                @foreach($group as $perm)
                    <div class="col-md-6">
                        <div class="perm-item-card">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 38px; height: 38px; background: rgba(231, 84, 128, 0.08); color: #e75480;">
                                    <i class="bi bi-key-fill"></i>
                                </div>
                                <span class="fw-bold text-dark fs-6 text-capitalize">
                                    {{ str_replace('-', ' ', $perm->name) }}
                                </span>
                            </div>

                            <form action="{{ route('admin.permissions.destroy', $perm->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Are you sure you want to permanently delete this permission? This may break existing roles.')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="action-icon-btn delete" title="Delete Permission">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        @empty
            <div class="text-center py-5 bg-white shadow-sm border-0 rounded-4 mt-4" style="background: rgba(255, 255, 255, 0.8) !important; backdrop-filter: blur(10px);">
                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="rounded-circle bg-light shadow-sm d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-shield-x text-muted" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="font-serif fw-bold text-dark">No Permissions Configured</h4>
                    <p class="text-muted fw-medium fs-6">Click 'Add Permission' to start defining system capabilities.</p>
                </div>
            </div>
        @endforelse

    </div>

</div>
@endsection