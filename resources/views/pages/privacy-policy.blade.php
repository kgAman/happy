@extends('layouts.master')

@section('title', 'Privacy Policy | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --brand-pink: #e75480;
        --brand-pink-light: rgba(231, 84, 128, 0.1);
        --text-dark: #1a0f1c; 
        --text-on-dark: #ffffff; 
        --glass-bg: rgba(0, 0, 0, 0.55); 
        --glass-border: rgba(255, 255, 255, 0.15);
    }

    /* --- HEADER STYLING: FULL WHITE MENU --- */
    .navbar {
        background-color: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: none !important;
    }
    /* Targets Home, Search, Profiles, and all other nav links */
    .navbar .nav-link, 
    .navbar .navbar-brand, 
    .navbar .navbar-toggler-icon,
    .navbar .dropdown-toggle,
    .navbar .btn-link,
    .navbar span,
    .navbar i {
        color: #ffffff !important;
        opacity: 1 !important; /* Ensure no fading */
    }
    
    .navbar .nav-link:hover {
        color: var(--brand-pink) !important;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-on-dark);
        position: relative;
        overflow-x: hidden;
        /* PAGE BACKGROUND: REDUCED OPACITY GRADIENT */
        background-color: #000000;
        background-image: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(231, 84, 128, 0.85) 100%);
        background-attachment: fixed;
    }

    .font-playfair { font-family: 'Playfair Display', serif; }

    .text-gradient-card {
        background: linear-gradient(135deg, var(--brand-pink) 0%, #ffffff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* --- BACKGROUND MATRIMONY SVGS (HIGH VISIBILITY) --- */
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

    /* --- HERO SECTION --- */
    .vibrant-hero {
        padding: 180px 20px 80px;
        text-align: center;
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15); 
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 8px 24px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        font-weight: 600;
        color: #ffffff; 
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        margin-bottom: 25px;
    }
    
    .hero-badge i { color: var(--brand-pink); }

    .vibrant-hero h1 {
        font-size: clamp(3.5rem, 7vw, 5.5rem);
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.1;
        letter-spacing: -2px;
        color: #ffffff; 
        text-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .vibrant-hero p {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.95); 
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
        font-weight: 400;
    }

    /* --- GRID LAYOUT --- */
    .vibrant-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 40px 30px 100px;
        position: relative;
        z-index: 10;
    }

    .vibrant-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 60px;
        align-items: start;
    }

    .glass-sidebar {
        background: rgba(0, 0, 0, 0.6); 
        backdrop-filter: blur(24px);
        border: 1px solid var(--glass-border);
        border-radius: 30px;
        padding: 40px 30px;
        position: sticky;
        top: 120px;
    }

    .sidebar-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: #ffffff;
        border-bottom: 1px solid var(--glass-border);
        padding-bottom: 15px;
    }

    .toc-nav { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; }
    .toc-nav a { display: flex; align-items: center; gap: 15px; padding: 12px 18px; color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease; border-radius: 16px; }
    .toc-nav a:hover { background: rgba(255, 255, 255, 0.1); color: #ffffff; }
    .toc-nav a.active { background: linear-gradient(135deg, var(--brand-pink) 0%, #000000 100%); color: white; font-weight: 600; }

    /* --- GLASS CONTENT CARDS --- */
    .content-area { display: flex; flex-direction: column; gap: 50px; }
    .glass-card {
        background: rgba(0, 0, 0, 0.55); 
        backdrop-filter: blur(24px);
        border: 1px solid var(--glass-border);
        border-radius: 35px;
        padding: 50px 60px;
        position: relative;
        overflow: hidden;
        transition: transform 0.4s ease;
    }
    .glass-card:hover { transform: translateY(-5px); border-color: rgba(255, 255, 255, 0.3); }
    .glass-card::before {
        content: attr(data-number);
        position: absolute;
        top: -10px; right: 20px;
        font-family: 'Playfair Display', serif;
        font-size: 12rem;
        font-weight: 700;
        background: linear-gradient(180deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        pointer-events: none;
    }

    .card-header-icon {
        width: 70px; height: 70px;
        background: linear-gradient(135deg, var(--brand-pink) 0%, #000000 100%);
        color: white;
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        margin-bottom: 25px;
    }

    .glass-card h2 { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: #ffffff; margin-bottom: 20px; }
    .glass-card > p { font-size: 1.15rem; line-height: 1.8; color: rgba(255, 255, 255, 0.85); margin-bottom: 35px; }

    .clause-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; }
    .clause-item { background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); padding: 30px; border-radius: 24px; transition: all 0.3s ease; }
    .clause-item h4 { font-size: 1.25rem; font-weight: 700; color: #ffffff; margin-bottom: 12px; }
    .clause-item p { font-size: 1rem; line-height: 1.6; color: rgba(255, 255, 255, 0.7); margin: 0; }
    .clause-icon { font-size: 1.8rem; color: var(--brand-pink); margin-bottom: 15px; display: inline-block; background: rgba(231, 84, 128, 0.15); width: 50px; height: 50px; text-align: center; line-height: 50px; border-radius: 14px; }

    .clause-highlight { background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(231, 84, 128, 0.15) 100%); border: 1px solid rgba(231, 84, 128, 0.4); }

    @media (max-width: 992px) {
        .vibrant-grid { grid-template-columns: 1fr; }
        .vibrant-hero { padding-top: 140px; }
    }
</style>
@endpush

@section('content')

<div class="bg-matrimony-patterns">
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

<section class="vibrant-hero">
    <div class="hero-badge"><i class="bi bi-shield-check-fill"></i> Legal & Trust</div>
    <h1 class="font-playfair">Privacy Policy</h1>
    <p>A transparent look into how we protect, secure, and utilize your personal information to foster genuine matrimonial connections.</p>
</section>

<div class="vibrant-container">
    <div class="vibrant-grid">
        <aside class="glass-sidebar">
            <h3 class="sidebar-title">Directory</h3>
            <ul class="toc-nav">
                <li><a href="#section-1"><i class="bi bi-database"></i> Data Collection</a></li>
                <li><a href="#section-2"><i class="bi bi-gear"></i> Usage & Processing</a></li>
                <li><a href="#section-3"><i class="bi bi-eye"></i> Visibility Rules</a></li>
                <li><a href="#section-4"><i class="bi bi-shield-lock"></i> Security Architecture</a></li>
                <li><a href="#section-5"><i class="bi bi-person-check"></i> Your Rights</a></li>
                <li><a href="#section-6"><i class="bi bi-journal-text"></i> Policy Revisions</a></li>
            </ul>
        </aside>

        <div class="content-area">
            
            <div class="glass-card" id="section-1" data-number="1">
                <div class="card-header-icon"><i class="bi bi-database"></i></div>
                <h2 class="text-gradient-card">Information We Collect</h2>
                <p>To facilitate meaningful, lifelong connections and ensure a trusted environment, we collect highly specific information across four primary categories during your journey with HappilyWeds.</p>
                <div class="clause-grid">
                    <div class="clause-item">
                        <i class="bi bi-person-vcard clause-icon"></i>
                        <h4>Identity Data</h4>
                        <p>Includes your full legal name, gender, exact date of birth, and current marital status. This forms the absolute baseline of your public profile.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-heart-pulse clause-icon"></i>
                        <h4>Sensitive Filters</h4>
                        <p>To provide accurate match-making, we securely collect details regarding religion, caste, mother tongue, physical attributes, and profession.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-patch-check clause-icon"></i>
                        <h4>Verification Proofs</h4>
                        <p>For our "Verified Badge" program, we process Government IDs alongside your verified phone number and email in a secure, isolated vault.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-cpu clause-icon"></i>
                        <h4>Technical Logs</h4>
                        <p>We automatically log your IP address, browser type, and session cookies to ensure platform stability, speed, and fraud prevention.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card" id="section-2" data-number="2">
                <div class="card-header-icon"><i class="bi bi-gear"></i></div>
                <h2 class="text-gradient-card">Usage & Processing</h2>
                <p>Your data is never collected passively. Every single data point serves a distinct purpose: to enhance your experience, refine your matches, and keep our community impenetrable to bad actors.</p>
                <div class="clause-grid">
                    <div class="clause-item">
                        <i class="bi bi-diagram-3 clause-icon"></i>
                        <h4>Matchmaking Optimization</h4>
                        <p>We utilize your preferences and attributes to power our intelligent algorithms, ensuring you see highly compatible profiles tailored to your life goals.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-shield-shaded clause-icon"></i>
                        <h4>Fraud Detection</h4>
                        <p>Behavioral data and technical logs are strictly analyzed by our automated security systems to identify and remove scammers and bots proactively.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-chat-dots clause-icon"></i>
                        <h4>Communication</h4>
                        <p>Your contact data allows us to send critical account alerts, new match notifications, and securely route internal messages without exposing your personal phone number.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card" id="section-3" data-number="3">
                <div class="card-header-icon"><i class="bi bi-eye"></i></div>
                <h2 class="text-gradient-card">Visibility Rules</h2>
                <p>You have absolute control over what the community sees. We provide granular settings to manage your digital footprint.</p>
                <div class="clause-grid">
                    <div class="clause-item">
                        <i class="bi bi-globe clause-icon"></i>
                        <h4>Public Profile</h4>
                        <p>Basic information, approved photos, and general lifestyle choices are visible to other registered, active members of the platform.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-incognito clause-icon"></i>
                        <h4>Masked Contact Details</h4>
                        <p>Your phone number and email address are never displayed publicly. Members must use our secure in-app messaging to initiate contact.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card" id="section-4" data-number="4">
                <div class="card-header-icon"><i class="bi bi-shield-lock"></i></div>
                <h2 class="text-gradient-card">Security Architecture</h2>
                <p>We deploy military-grade security infrastructure to ensure your most sensitive personal information remains inaccessible to unauthorized parties.</p>
                <div class="clause-grid">
                    <div class="clause-item">
                        <i class="bi bi-file-lock clause-icon"></i>
                        <h4>End-to-End Encryption</h4>
                        <p>All data transmitted between your device and our servers is secured using advanced TLS protocols to prevent interception.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-hdd-network clause-icon"></i>
                        <h4>Isolated Storage</h4>
                        <p>Sensitive documents, such as Government Verification IDs, are stored on heavily restricted servers separate from regular database traffic.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card" id="section-5" data-number="5">
                <div class="card-header-icon"><i class="bi bi-person-check"></i></div>
                <h2 class="text-gradient-card">Your Rights</h2>
                <p>We respect your ownership over your personal data. HappilyWeds provides streamlined processes for you to exercise your privacy rights.</p>
                <div class="clause-grid">
                    <div class="clause-item">
                        <i class="bi bi-cloud-download clause-icon"></i>
                        <h4>Right to Access</h4>
                        <p>You may request a comprehensive export of all personal data we hold associated with your account at any time.</p>
                    </div>
                    <div class="clause-item">
                        <i class="bi bi-eraser clause-icon"></i>
                        <h4>Right to Erasure</h4>
                        <p>Upon profile deletion, your data is permanently scrubbed from our active databases, subject only to strict legal retention mandates.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card" id="section-6" data-number="6">
                <div class="card-header-icon"><i class="bi bi-journal-text"></i></div>
                <h2 class="text-gradient-card">Policy Revisions</h2>
                <div class="clause-grid">
                    <div class="clause-item clause-highlight" style="grid-column: 1 / -1;">
                        <i class="bi bi-bell clause-icon" style="color: var(--brand-pink); background: #ffffff;"></i>
                        <h4>Notification of Changes</h4>
                        <p style="font-size: 1.1rem; color: #ffffff;">We regularly review and update our privacy practices to adapt to new technologies and legal requirements. If substantial changes are made to how we handle your data, we will notify you prominently via email and in-app alerts prior to the changes taking effect.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Handle sticky navigation highlighting
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.toc-nav a');
        const sections = document.querySelectorAll('.glass-card');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetSection = document.getElementById(this.getAttribute('href').substring(1));
                window.scrollTo({top: targetSection.offsetTop - 140, behavior: 'smooth'});
            });
        });

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                if (pageYOffset >= (section.offsetTop - 300)) { current = section.getAttribute('id'); }
            });
            links.forEach(link => {
                link.classList.toggle('active', link.getAttribute('href').substring(1) === current);
            });
        });
    });
</script>
@endpush