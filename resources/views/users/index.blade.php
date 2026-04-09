@extends('layouts.admin')
@section('title', 'User Management - HappilyWeds')

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

    /* Floating Table Aesthetic */
    .premium-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important; 
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
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.7rem 1.8rem;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
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
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">User Management</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage system administrators and staff access.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn-glow shadow-sm d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-person-plus-fill me-2 border border-white rounded-circle d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; font-size: 0.8rem;"></i> 
            Add New User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card delay-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="animate-card delay-2">
        <div class="table-responsive" style="overflow-x: auto; padding-bottom: 20px;">
            <table class="table premium-table w-100">
                <thead>
                    <tr>
                        <th width="30%">User Identity</th>
                        <th>Email Address</th>
                        <th>System Role</th>
                        <th class="text-end pe-4" width="15%">Manage</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold me-4 shadow-sm text-white bg-gradient-signature" style="width: 48px; height: 48px; font-size: 1.2rem;">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark fs-5">
                                            {{ $u->name }}
                                        </h6>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="text-muted fw-semibold">
                                    <i class="bi bi-envelope-at-fill text-secondary me-2"></i>
                                    {{ $u->email }}
                                </span>
                            </td>

                            <td>
                                @if ($u->roles->first())
                                    <span class="badge rounded-pill fw-bold" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 8px 16px; font-size: 0.8rem;">
                                        <i class="bi bi-shield-lock-fill me-1"></i>
                                        {{ $u->roles->pluck('name')->first() }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill fw-bold" style="background: #f8fafc; color: #4a5568; border: 1px solid #e2e8f0; padding: 8px 16px; font-size: 0.8rem;">
                                        No Role Assigned
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="action-icon-btn edit" title="Edit User">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-icon-btn delete" title="Delete User">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection