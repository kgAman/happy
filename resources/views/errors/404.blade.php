@extends('layouts.master')

@section('title', 'Page Not Found | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --brand-pink: #e75480;
        --text-dark: #1a0f1c; 
        --glass-bg: rgba(0, 0, 0, 0.55); 
        --glass-border: rgba(255, 255, 255, 0.15);
    }

    /* --- HEADER STYLING: TRANSPARENT BG + WHITE TEXT --- */
    .navbar {
        background-color: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: none !important;
    }
    .navbar .nav-link, 
    .navbar .navbar-brand, 
    .navbar .navbar-toggler-icon,
    .navbar .btn {
        color: #ffffff !important;
    }
    .navbar-brand i, .navbar-brand span {
        color: #ffffff !important;
    }

    body {
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
        /* PAGE BACKGROUND: BLACK TO PINK, LEFT TO RIGHT */
        background-image: linear-gradient(90deg, #000000 0%, #e75480 100%);
        background-attachment: fixed;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* --- BACKGROUND MATRIMONY SVGS --- */
    .bg-matrimony-patterns {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .floating-svg {
        position: absolute;
        fill: none;
        stroke-width: 2.5; 
        animation: floatMatrimony var(--duration) ease-in-out infinite alternate;
        filter: drop-shadow(0px 0px 10px rgba(255, 255, 255, 0.2)); 
    }

    .svg-rings { top: 15%; left: 5%; width: 280px; height: 280px; --duration: 12s; transform: rotate(-15deg); stroke: rgba(255,255,255,0.3); }
    .svg-mandala { top: 50%; right: -5%; width: 550px; height: 550px; --duration: 25s; animation: rotateSlow 60s linear infinite; stroke: rgba(255,255,255,0.25); }
    .svg-heart { bottom: 12%; left: 18%; width: 200px; height: 200px; --duration: 9s; transform: rotate(10deg); fill: rgba(255,255,255,0.2); stroke: none;}

    @keyframes rotateSlow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    @keyframes floatMatrimony { 0% { transform: translateY(0) rotate(0deg) scale(1); } 100% { transform: translateY(-40px) rotate(8deg) scale(1.05); } }

    /* --- ERROR LAYOUT --- */
    .error-wrapper {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 10;
        padding: 40px 20px;
        min-height: calc(100vh - 80px); /* Adjust based on your navbar height */
    }

    .error-glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        padding: 60px 40px;
        max-width: 700px;
        width: 100%;
        text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        animation: fadeSlideUp 0.6s ease forwards;
    }

    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .error-code {
        font-family: 'Playfair Display', serif;
        font-size: clamp(6rem, 15vw, 10rem);
        font-weight: 800;
        line-height: 1;
        margin: 0 0 10px 0;
        background: linear-gradient(135deg, #ffffff 0%, var(--brand-pink) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 10px 30px rgba(231,84,128,0.3);
    }

    .error-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
    }

    .error-desc {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .btn-action-solid {
        background: linear-gradient(135deg, var(--brand-pink) 0%, #000000 100%);
        color: white;
        border: 1px solid var(--brand-pink);
        padding: 14px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(231, 84, 128, 0.3);
        text-decoration: none;
    }

    .btn-action-solid:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(231, 84, 128, 0.5);
        color: white;
    }
</style>
@endpush

@section('content')

<div class="bg-matrimony-patterns d-none d-lg-block">
    <svg class="floating-svg svg-rings" viewBox="0 0 100 100">
        <circle cx="35" cy="50" r="25" />
        <circle cx="65" cy="50" r="25" />
    </svg>
    <svg class="floating-svg svg-heart" viewBox="0 0 24 24">
        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
    </svg>
    <svg class="floating-svg svg-mandala" viewBox="0 0 100 100">
        <path d="M50 0 C60 30 70 30 100 50 C70 70 60 70 50 100 C40 70 30 70 0 50 C30 30 40 30 50 0 Z" />
        <circle cx="50" cy="50" r="10" />
    </svg>
</div>

<div class="error-wrapper">
    <div class="error-glass-card">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Oops! You've strayed from the aisle.</h2>
        <p class="error-desc">
            It looks like the page you are looking for has been moved, deleted, or never existed in the first place. Let's get you back on track to finding your perfect match.
        </p>
        
        <a href="{{ url('/') }}" class="btn-action-solid">
            <i class="bi bi-house-door-fill"></i> Return Home
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Force Navbar background to transparent with white text dynamically
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            navbar.style.backgroundColor = 'transparent';
            navbar.style.borderBottom = '1px solid rgba(255,255,255,0.1)';
            navbar.style.boxShadow = 'none';
            
            const navLinks = navbar.querySelectorAll('.nav-link, .navbar-brand, .navbar-brand i, .navbar-brand span, .btn-link');
            navLinks.forEach(link => {
                link.style.setProperty('color', '#ffffff', 'important');
                link.style.setProperty('opacity', '1', 'important');
            });
        }
    });
</script>
@endpush