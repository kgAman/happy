<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Dancing+Script:wght@600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500&display=swap');

    /* --- Dramatic Midnight Stories Section (Strictly Scoped) --- */
    .stories-section {
        padding: 140px 0;
        background: linear-gradient(to bottom, #0a040b 0%, #160814 100%);
        position: relative;
        overflow: hidden;
    }

    .stories-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100vw;
        height: 100%;
        background: radial-gradient(circle at 50% 20%, rgba(231, 84, 128, 0.05) 0%, transparent 60%);
        pointer-events: none;
    }

    /* Scoped Section Title */
    .stories-section .section-title {
        text-align: center;
        margin-bottom: 90px;
        position: relative;
        z-index: 2;
    }

    .stories-section .section-title h2 {
        font-family: 'Cinzel', serif; 
        font-size: 3.5rem;
        font-weight: 700;
        background: linear-gradient(to right, #D4AF37, #FFF4D2, #D4AF37);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 25px;
        letter-spacing: 2px;
        text-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    }
    
    /* Remove the pink underline from the global section-title just for this section */
    .stories-section .section-title h2::after {
        display: none; 
    }

    .stories-section .section-title p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        color: #a895a2; 
        max-width: 600px;
        margin: 0 auto;
        font-weight: 300;
    }

    /* --- Scoped Dark Velvet Card --- */
    .stories-section .love-letter-card {
        background: linear-gradient(145deg, #1d0f1a 0%, #11070e 100%);
        border-radius: 16px; 
        padding: 60px 40px 40px;
        position: relative;
        height: 100%;
        border: 1px solid rgba(231, 84, 128, 0.3);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8), 
                    inset 0 0 40px rgba(231, 84, 128, 0.05); 
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 1;
        overflow: hidden;
    }

    .stories-section .love-letter-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 50% 0%, rgba(212, 175, 55, 0.15), transparent 50%);
        opacity: 0;
        transition: opacity 0.6s ease, transform 0.8s ease;
        pointer-events: none;
    }

    .stories-section .love-letter-card:hover {
        transform: translateY(-15px) scale(1.02); 
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), 
                    0 0 30px rgba(231, 84, 128, 0.2),
                    inset 0 0 20px rgba(212, 175, 55, 0.1);
        border-color: rgba(212, 175, 55, 0.6); 
        z-index: 10;
    }

    .stories-section .love-letter-card:hover::after {
        opacity: 1;
        transform: translateY(20%);
    }

    /* --- Scoped Glowing Ruby Wax Seal --- */
    .stories-section .wax-seal {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 55px;
        height: 55px;
        background: radial-gradient(circle at 30% 30%, #ff2a85 0%, #990033 60%, #4d0019 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.4rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.6), 
                    inset 0 0 8px rgba(255,255,255,0.4),
                    0 0 20px rgba(255, 42, 133, 0.4); 
        z-index: 5;
        animation: pulseGlow 3s infinite alternate;
    }

    @keyframes pulseGlow {
        0% { box-shadow: 0 10px 20px rgba(0,0,0,0.6), inset 0 0 8px rgba(255,255,255,0.4), 0 0 10px rgba(255, 42, 133, 0.2); }
        100% { box-shadow: 0 10px 20px rgba(0,0,0,0.6), inset 0 0 8px rgba(255,255,255,0.4), 0 0 30px rgba(255, 42, 133, 0.6); }
    }

    .stories-section .love-letter-card::before {
        content: '❝';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 10rem;
        color: rgba(255, 255, 255, 0.03); 
        font-family: 'Playfair Display', serif;
        line-height: 1;
        z-index: 0;
    }

    /* --- Scoped Metallic Gold Ink Text --- */
    .stories-section .story-text {
        font-family: 'Dancing Script', cursive; 
        font-size: 1.8rem;
        color: #F3E5AB; 
        line-height: 1.6;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
        text-shadow: 0 0 15px rgba(212, 175, 55, 0.4), 1px 1px 1px rgba(0,0,0,0.8); 
    }

    /* --- Scoped Cinematic Divider --- */
    .stories-section .story-divider {
        text-align: center;
        margin: 35px 0;
        position: relative;
    }
    
    .stories-section .story-divider::before {
        content: '✦'; 
        font-size: 1.5rem;
        color: #e75480;
        background: transparent; /* Changed from solid black to transparent to stop clipping the gradient line */
        padding: 0 20px;
        position: relative;
        z-index: 2;
        text-shadow: 0 0 10px #e75480;
    }

    .stories-section .story-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(231, 84, 128, 0.6), transparent);
        z-index: 1;
    }

    /* --- Scoped Polaroid Couple Info --- */
    .stories-section .story-couple {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 2;
    }

    .stories-section .couple-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #D4AF37; 
        box-shadow: 0 10px 20px rgba(0,0,0,0.8), 0 0 15px rgba(212, 175, 55, 0.2);
        transform: rotate(-3deg); 
        transition: all 0.5s ease;
        filter: contrast(1.1) saturate(1.2); 
    }

    .stories-section .love-letter-card:hover .couple-avatar {
        transform: rotate(0deg) scale(1.1);
        box-shadow: 0 15px 30px rgba(0,0,0,0.9), 0 0 25px rgba(212, 175, 55, 0.5);
    }

    .stories-section .couple-info h4 {
        margin: 0 0 4px;
        color: #ffffff;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
    }

    .stories-section .couple-info p {
        margin: 0;
        color: #a895a2;
        font-family: 'Poppins', sans-serif;
    }
</style>

<section class="stories-section">
    <div class="container">
        <div class="section-title">
            <h2>Tales of Love</h2>
            <p>Read beautiful letters from real couples who found their "Happily Ever After" with us.</p>
        </div>
        
        <div class="row g-4">
            @if(isset($successStories))
                @foreach($successStories as $story)
                <div class="col-lg-4">
                    <div class="love-letter-card">
                        
                        <div class="wax-seal">
                            <i class="bi bi-heart-fill"></i>
                        </div>

                        <div class="story-content">
                            <div class="story-text">
                                "{{ $story['quote'] }}"
                            </div>
                        </div>

                        <div class="story-divider"></div>

                        <div class="story-couple">
                            <img src="{{ $story['image'] }}" alt="{{ $story['couple'] }}" class="couple-avatar">
                            <div class="couple-info">
                                <h4>{{ $story['couple'] }}</h4>
                                <p style="font-size: 0.85rem; font-style: italic; opacity: 0.8;">
                                    Married on {{ $story['date'] }}
                                </p>
                                <p style="font-size: 0.85rem; margin-top: 4px; color: #e75480; font-weight: 500; text-shadow: 0 0 10px rgba(231,84,128,0.3);">
                                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $story['location'] }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>