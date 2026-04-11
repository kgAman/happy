@extends('layouts.admin')

@section('title', 'Create New Profile | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* --- FIX 1: SPACING FROM SIDEBAR AND TOP --- */
    .admin-content-spacing {
        padding: 40px 50px; /* This creates the gap from the sidebar! */
        max-width: 1600px;
        margin: 0 auto;
        min-height: 100vh;
    }

    /* --- FIX 2: THE WHITE FORM CONTAINER --- */
    .form-white-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 50px 60px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9;
    }

    /* --- FIX 3: OVERRIDE FORM SECTION HEADERS --- */
    /* Since the main box is now white, we give the section headers a soft gray tint so they stand out */
    .section-header-card {
        background: #f8fafc !important; 
        border: 1px solid #e2e8f0 !important;
        box-shadow: none !important;
        border-radius: 16px !important;
    }

    /* Alerts */
    .premium-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 5px solid #ef4444;
        color: #991b1b;
        border-radius: 16px;
        padding: 20px 25px;
        margin-bottom: 30px;
    }

    /* Back Button */
    .btn-action-outline {
        background: #ffffff;
        color: #475569;
        border: 2px solid #e2e8f0;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .btn-action-outline:hover {
        background: #f8fafc;
        border-color: #111111;
        color: #111111;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .admin-content-spacing { padding: 20px; }
        .form-white-card { padding: 30px 20px; border-radius: 20px; }
    }
</style>
@endpush

@section('content')
<div class="admin-content-spacing font-sans">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.8rem; letter-spacing: -1px;">
            Create New Profile
        </h2>
        <a href="{{ route('admin.profiles.index') }}" class="btn-action-outline shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Back to Directory
        </a>
    </div>

    <div class="form-white-card">
        
        @if ($errors->any())
            <div class="premium-alert">
                <h5 class="fw-bold mb-3 text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the following errors:
                </h5>
                <ul class="mb-0 fw-medium">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('profiles.form')

    </div>
</div>
@endsection