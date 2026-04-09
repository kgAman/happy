<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    /* --- Scoped 'How It Works' Timeline Section --- */
    .hiw-section {
        padding: 120px 20px;
        background-color: #fdfcfc; 
        font-family: 'Poppins', sans-serif;
        overflow: hidden;
    }

    /* Header & Titles */
    .hiw-header {
        text-align: center;
        margin-bottom: 80px;
    }
    .hiw-badge {
        color: #e75480;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }
    .hiw-badge svg {
        width: 18px;
        height: 18px;
        stroke-width: 2.5px;
    }
    .hiw-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.2rem;
        color: #2d1b2e;
        font-weight: 500;
        margin: 0;
    }

    /* --- Mathematical Timeline Container --- */
    .hiw-timeline {
        position: relative;
        max-width: 900px; 
        height: 900px; 
        margin: 0 auto;
    }

    /* The perfectly calculated SVG S-Curve */
    .hiw-curve {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    /* --- The Steps (Absolute Positioning) --- */
    .hiw-step {
        position: absolute;
        width: 100%;
        transform: translateY(-50%); 
        z-index: 2;
    }

    /* Y-Axis Alignment */
    .step-1 { top: 12.5%; }
    .step-2 { top: 37.5%; }
    .step-3 { top: 62.5%; }
    .step-4 { top: 87.5%; }

    /* --- The Content Boxes --- */
    .hiw-card {
        width: 42%; 
        display: flex;
        align-items: flex-start;
        gap: 20px;
        background: #ffffff;
        padding: 30px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(231, 84, 128, 0.05);
        border: 1px solid rgba(231, 84, 128, 0.1);
        transition: all 0.4s ease;
        position: relative;
        z-index: 3;
    }

    .hiw-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(231, 84, 128, 0.12);
        border-color: rgba(231, 84, 128, 0.25);
    }

    /* Directional Formatting */
    .step-1 .hiw-card, .step-3 .hiw-card {
        margin-right: auto; 
    }
    
    .step-2 .hiw-card, .step-4 .hiw-card {
        margin-left: auto; 
        flex-direction: row-reverse;
        text-align: right;
    }

    /* --- The Bolted Concentric Dots --- */
    .hiw-dot {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%); 
        width: 26px;
        height: 26px;
        background: #e75480;
        border: 5px solid #fffafb;
        box-shadow: 0 0 0 2px rgba(231, 84, 128, 0.5), 0 5px 10px rgba(231, 84, 128, 0.2);
        border-radius: 50%;
        z-index: 4;
        transition: all 0.4s ease;
    }

    .hiw-dot::after {
        content: '';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background-color: #fffafb;
        border-radius: 50%;
    }

    /* X-Axis Alignment */
    .step-1 .hiw-dot, .step-3 .hiw-dot { left: 80%; }
    .step-2 .hiw-dot, .step-4 .hiw-dot { left: 20%; }

    .hiw-step:hover .hiw-dot {
        background: #d4af37; 
        box-shadow: 0 0 0 2px #d4af37, 0 5px 15px rgba(212, 175, 55, 0.4);
        transform: translate(-50%, -50%) scale(1.3);
    }

    /* --- Lucide Icon Boxes --- */
    .hiw-icon {
        width: 65px;
        height: 65px;
        border-radius: 16px;
        background-color: #faedf2; 
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #e75480; 
    }
    
    .hiw-icon svg {
        width: 28px;
        height: 28px;
        stroke-width: 2px;
    }

    /* --- Text Styling --- */
    .hiw-text-block { flex: 1; }
    
    .hiw-step-label {
        display: block;
        color: #f18eb0; 
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 6px;
    }
    
    .hiw-text-block h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: #2d1b2e;
        font-weight: 500;
        margin: 0 0 10px 0;
    }
    
    .hiw-text-block p {
        color: #6b5b6b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    /* --- Mobile Straight-Line Fallback --- */
    .hiw-mobile-line { display: none; }

    @media (max-width: 768px) {
        .hiw-curve { display: none; } 
        .hiw-timeline { height: auto; padding-left: 30px; margin-top: 40px; }
        
        .hiw-mobile-line {
            display: block;
            position: absolute;
            left: 43px; 
            top: 0;
            bottom: 0;
            width: 2px;
            border-left: 2px dashed rgba(231, 84, 128, 0.3);
            z-index: 0;
        }

        .hiw-step {
            position: relative;
            top: auto !important;
            transform: none !important;
            margin-bottom: 50px;
            padding-left: 40px;
        }

        .hiw-card {
            width: 100%;
            flex-direction: row !important;
            text-align: left !important;
        }

        .hiw-dot {
            left: 13px !important;
            top: 50% !important;
        }
    }
    
    @media (max-width: 480px) {
        .hiw-card {
            flex-direction: column !important;
            gap: 15px;
            padding: 25px 20px;
        }
    }
</style>

<section class="hiw-section">
    <div class="container">
        <div class="hiw-header">
            <div class="hiw-badge">
                <i data-lucide="sparkles"></i> SIMPLE STEPS
            </div>
            <h2>How It Works</h2>
        </div>

        <div class="hiw-timeline">
            
            <svg class="hiw-curve" viewBox="0 0 1000 1000" preserveAspectRatio="none" fill="none">
                <path d="M 500 0 
                         C 900 0, 900 250, 500 250 
                         C 100 250, 100 500, 500 500 
                         C 900 500, 900 750, 500 750 
                         C 100 750, 100 1000, 500 1000" 
                      stroke="rgba(231, 84, 128, 0.25)" stroke-width="2.5" stroke-dasharray="10 8" stroke-linecap="round" />
            </svg>

            <div class="hiw-mobile-line"></div>

            <div class="hiw-step step-1">
                <div class="hiw-dot"></div>
                <div class="hiw-card">
                    <div class="hiw-icon"><i data-lucide="file-edit"></i></div>
                    <div class="hiw-text-block">
                        <span class="hiw-step-label">Step 1</span>
                        <h3>Create Profile</h3>
                        <p>Sign up and create your detailed profile with photos and preferences.</p>
                    </div>
                </div>
            </div>

            <div class="hiw-step step-2">
                <div class="hiw-dot"></div>
                <div class="hiw-card">
                    <div class="hiw-icon"><i data-lucide="heart-handshake"></i></div>
                    <div class="hiw-text-block">
                        <span class="hiw-step-label">Step 2</span>
                        <h3>Find Matches</h3>
                        <p>Browse compatible profiles or let our AI suggest perfect matches.</p>
                    </div>
                </div>
            </div>

            <div class="hiw-step step-3">
                <div class="hiw-dot"></div>
                <div class="hiw-card">
                    <div class="hiw-icon"><i data-lucide="message-circle"></i></div>
                    <div class="hiw-text-block">
                        <span class="hiw-step-label">Step 3</span>
                        <h3>Connect Safely</h3>
                        <p>Use our secure messaging system to connect with potential matches.</p>
                    </div>
                </div>
            </div>

            <div class="hiw-step step-4">
                <div class="hiw-dot"></div>
                <div class="hiw-card">
                    <div class="hiw-icon"><i data-lucide="gem"></i></div>
                    <div class="hiw-text-block">
                        <span class="hiw-step-label">Step 4</span>
                        <h3>Meet & Marry</h3>
                        <p>Take the relationship forward with family approval and plan your wedding.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>