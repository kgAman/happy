<style>
    /* --- CSS Variables mapped from Tailwind TSX --- */
    :root {
        --primary: #ff758c; /* Romantic Pink */
        --primary-foreground: #ffffff;
        --foreground: #2d3748; /* Neater, softer slate gray instead of harsh black */
        --muted-foreground: #718096; /* Elegant muted text */
        
        /* The custom gradients from your TSX */
--gradient-aurora: linear-gradient(
    45deg,
    rgba(255, 117, 140, 0.4),
    rgba(255, 182, 193, 0.4),
    rgba(255, 160, 180, 0.4),
    rgba(255, 230, 235, 0.4)
);        --gradient-romantic: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        --shadow-romantic: 0 10px 25px rgba(255, 117, 140, 0.4);
    }

    /* --- Hero Styles --- */
    .hero-section {
        position: relative;
        padding: 200px 0 140px;
        background-color: #ffffff;
        text-align: center;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    /* --- 1. Gradient Wave Background --- */
    .gradient-wave {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: var(--gradient-aurora);
        background-size: 400% 400%;
        animation: gradient-wave-anim 8s ease infinite;
        z-index: 1;
        pointer-events: none;
        opacity: 0.6;
    }
    @keyframes gradient-wave-anim {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* --- 2. Floating Hearts Animation --- */
    .floating-heart {
        position: absolute;
        bottom: -20px;
        color: var(--primary); 
        pointer-events: none;
        z-index: 1;
    }
    @keyframes float-heart {
        0% { transform: translateY(0) scale(1) rotate(0deg); opacity: 1; }
        100% { transform: translateY(-100vh) scale(1.5) rotate(45deg); opacity: 0; }
    }

    .hero-content {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        width: 100%;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem;
        font-weight: 800;
        margin-bottom: 1.2rem;
        line-height: 1.1;
        color: #1a202c; /* Slightly darker for heading only */
        letter-spacing: -1px;
    }

    /* --- 3. Text Reveal & FadeInUp --- */
    .char-reveal {
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.7s ease-out;
    }
    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 4rem;
        color: var(--muted-foreground);
        line-height: 1.6;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        letter-spacing: 0.5px;
    }

    /* --- The Unique Floating Pill Form --- */
    .unique-search-bar {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 117, 140, 0.25);
        border-radius: 60px;
        padding: 10px 10px 10px 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06), inset 0 0 20px rgba(255,255,255,0.8);
        transition: all 0.4s ease;
    }

    .unique-search-bar:hover {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(255, 117, 140, 0.4);
        box-shadow: 0 25px 50px rgba(255, 117, 140, 0.15);
    }

    .search-field {
        flex: 1;
        display: flex;
        flex-direction: column;
        text-align: left;
        padding: 5px 20px;
        border-right: 1px solid rgba(0, 0, 0, 0.08);
        position: relative; /* Needed for custom dropdown */
    }

    .search-field:nth-last-child(2) {
        border-right: none;
    }

    .search-field label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: var(--muted-foreground); /* Softer label color */
        margin-bottom: 4px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Hide native select since we are replacing it */
    .search-field select {
        display: none; 
    }

    /* --- Custom Animated Dropdown Styles --- */
    .custom-select-wrapper {
        position: relative;
        user-select: none;
        width: 100%;
    }

    .custom-select-trigger {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--foreground);
        cursor: pointer;
        padding: 2px 0;
        transition: color 0.3s;
    }

    .custom-select-trigger:hover {
        color: var(--primary);
    }

    .custom-select-trigger .arrow {
        font-size: 0.8rem;
        color: var(--muted-foreground);
        transition: transform 0.3s ease;
    }

    .custom-select-wrapper.open .custom-select-trigger .arrow {
        transform: rotate(180deg);
        color: var(--primary);
    }

    .custom-options {
        position: absolute;
        top: calc(100% + 15px);
        left: -10px;
        right: -10px;
        min-width: 160px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 0 0 1px rgba(255, 117, 140, 0.1);
        list-style: none;
        padding: 8px 0;
        margin: 0;
        z-index: 100;
        
        /* Animation properties */
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        pointer-events: none;
    }

    .custom-select-wrapper.open .custom-options {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
        pointer-events: all;
    }

    .custom-option {
        padding: 10px 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        font-weight: 400;
        color: var(--foreground);
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }

    .custom-option:hover {
        background: rgba(255, 117, 140, 0.08);
        color: var(--primary);
        padding-left: 25px; /* Slight indent on hover */
    }

    .custom-option.selected {
        background: rgba(255, 117, 140, 0.1);
        color: var(--primary);
        font-weight: 600;
    }

    /* --- 4. Pulse Glow & Ripple Button --- */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 15px rgba(255, 117, 140, 0.3); }
        50% { box-shadow: 0 0 30px rgba(255, 117, 140, 0.7); }
    }
    
    .btn-search-circle {
        background: var(--gradient-romantic);
        color: var(--primary-foreground);
        border: none;
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
        box-shadow: var(--shadow-romantic);
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        animation: pulse-glow 2s ease-in-out infinite;
    }

    .btn-search-circle:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(255, 117, 140, 0.6);
    }

    .ripple-span {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple-anim 0.6s linear forwards;
        pointer-events: none;
    }
    @keyframes ripple-anim {
        to { transform: scale(4); opacity: 0; }
    }

    /* Forever Love text */
    .romantic-word {
        position: relative;
        display: inline-block;
        color: #e75480;
    }

    .romantic-word::before,
    .romantic-word::after {
        content: '❤';
        position: absolute;
        color: var(--primary);
        font-size: 1.5rem;
        opacity: 0;
        -webkit-text-fill-color: var(--primary);
        animation: heartFloatWords 3s infinite;
    }

    .romantic-word::before {
        top: -10px; right: -15px;
        font-size: 1.2rem;
        animation-delay: 0s;
    }
    .romantic-word::after {
        top: -25px; right: -30px;
        font-size: 0.8rem;
        animation-delay: 1.5s;
    }

    @keyframes heartFloatWords {
        0% { transform: translateY(10px) rotate(0deg) scale(0.5); opacity: 0; }
        50% { opacity: 0.8; }
        100% { transform: translateY(-20px) rotate(20deg) scale(1.2); opacity: 0; }
    }

    /* --- Mobile Responsive Form --- */
    @media (max-width: 991px) {
        .hero-title { font-size: 3.5rem; }
        .hero-section { padding: 160px 0 80px; display: block; }
        
        .unique-search-bar {
            flex-direction: column;
            border-radius: 24px;
            padding: 20px;
            gap: 15px;
        }

        .search-field {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 10px 5px;
        }

        .search-field:nth-last-child(2) { border-bottom: none; }

        .custom-options {
            top: 100%; /* Adjust dropdown position for mobile */
            left: 0; right: 0;
        }

        .btn-search-circle {
            width: 100%;
            border-radius: 12px;
            height: 55px;
            margin-left: 0;
            margin-top: 10px;
            font-size: 1.1rem;
            gap: 10px;
        }
        
        .btn-search-circle::after {
            content: 'Find Matches';
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title { font-size: 2.8rem; }
    }
</style>

<section class="hero-section" id="hero-section">
    <div class="gradient-wave"></div>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span id="letter-reveal-text">Find Your </span>
                        <span class="romantic-word fade-in-up" style="animation-delay: 1.5s;">Forever Love</span>
                    </h1>
                    
                    <p class="hero-subtitle fade-in-up">
                        Join thousands of successful matches on India's most premium matrimonial platform. 
                        Start your journey to finding true love and lifelong happiness today.
                    </p>
                    
                    <form action="{{ route('search') ?? '#' }}" method="GET" class="unique-search-bar fade-in-up">
                        <div class="search-field">
                            <label for="lookingFor">I'm looking for</label>
                            <select id="lookingFor" name="gender" required>
                                <option value="" disabled selected hidden>Select</option>
                                <option value="male">Bride</option>
                                <option value="female">Groom</option>
                            </select>
                        </div>
                        
                        <div class="search-field">
                            <label for="religion">Religion</label>
                            <select id="religion" name="religion">
                                <option value="" disabled selected hidden>Any</option>
                                <option value="hindu">Hindu</option>
                                <option value="muslim">Muslim</option>
                                <option value="christian">Christian</option>
                                <option value="sikh">Sikh</option>
                                <option value="jain">Jain</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="search-field">
                            <label for="age">Age</label>
                            <select id="age" name="age">
                                <option value="" disabled selected hidden>Any</option>
                                <option value="18-25">18-25 Years</option>
                                <option value="26-30">26-30 Years</option>
                                <option value="31-35">31-35 Years</option>
                                <option value="36-40">36-40 Years</option>
                                <option value="41+">41+ Years</option>
                            </select>
                        </div>
                        
                        <div class="search-field">
                            <label for="location">Location</label>
                            <select id="location" name="location">
                                <option value="" disabled selected hidden>Any</option>
                                <option value="delhi">Delhi</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="chennai">Chennai</option>
                                <option value="kolkata">Kolkata</option>
                                <option value="hyderabad">Hyderabad</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn-search-circle" id="pulse-btn" title="Search">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* --- 1. Custom Animated Dropdowns JS --- */
    const customSelects = document.querySelectorAll('.search-field select');
    
    customSelects.forEach(select => {
        // Create wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-select-wrapper';
        
        // Create trigger (the visible select box)
        const trigger = document.createElement('div');
        trigger.className = 'custom-select-trigger';
        
        const triggerText = document.createElement('span');
        triggerText.textContent = select.options[select.selectedIndex].text;
        
        const triggerArrow = document.createElement('span');
        triggerArrow.className = 'arrow';
        triggerArrow.innerHTML = '▼'; // Simple arrow, or use an SVG/icon
        
        trigger.appendChild(triggerText);
        trigger.appendChild(triggerArrow);
        
        // Create options list
        const optionsList = document.createElement('ul');
        optionsList.className = 'custom-options';
        
        Array.from(select.options).forEach(option => {
            if (option.hidden) return; // Skip placeholder
            
            const customOption = document.createElement('li');
            customOption.className = 'custom-option';
            customOption.textContent = option.text;
            customOption.dataset.value = option.value;
            
            if (option.selected) {
                customOption.classList.add('selected');
            }
            
            // Option click event
            customOption.addEventListener('click', function() {
                // Update native select
                select.value = this.dataset.value;
                
                // Update UI text
                triggerText.textContent = this.textContent;
                
                // Update selected class
                optionsList.querySelectorAll('.custom-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Close dropdown
                wrapper.classList.remove('open');
            });
            
            optionsList.appendChild(customOption);
        });
        
        // Wrap everything
        select.parentNode.insertBefore(wrapper, select);
        wrapper.appendChild(select); // move native select inside
        wrapper.appendChild(trigger);
        wrapper.appendChild(optionsList);
        
        // Toggle dropdown on trigger click
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Close other open dropdowns first
            document.querySelectorAll('.custom-select-wrapper').forEach(w => {
                if(w !== wrapper) w.classList.remove('open');
            });
            
            wrapper.classList.toggle('open');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
            wrapper.classList.remove('open');
        });
    });


    /* --- 2. Floating Hearts Logic --- */
    const heroSection = document.getElementById('hero-section');
    const heartCount = 12; 
    
    const heartSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>`;

    for(let i = 0; i < heartCount; i++) {
        let heart = document.createElement('div');
        heart.innerHTML = heartSvg;
        heart.className = 'floating-heart';
        
        let size = 12 + Math.random() * 20;
        heart.style.width = size + 'px';
        heart.style.height = size + 'px';
        heart.style.left = Math.random() * 100 + '%';
        heart.style.opacity = 0.2 + Math.random() * 0.5;
        
        let duration = 6 + Math.random() * 8;
        let delay = Math.random() * 8;
        heart.style.animation = `float-heart ${duration}s ease-in-out ${delay}s infinite`;
        
        heroSection.appendChild(heart);
    }

    /* --- 3. LetterByLetter Reveal Logic --- */
    const textNode = document.getElementById('letter-reveal-text');
    if(textNode) {
        const text = textNode.textContent;
        textNode.textContent = ''; 
        const speed = 50; 
        
        setTimeout(() => {
            text.split('').forEach((char, index) => {
                let span = document.createElement('span');
                span.innerHTML = char === ' ' ? '&nbsp;' : char;
                span.className = 'char-reveal';
                textNode.appendChild(span);
                
                setTimeout(() => {
                    span.style.opacity = 1;
                }, index * speed);
            });
        }, 100);
    }

    /* --- 4. FadeInUp Logic --- */
    const fadeElements = document.querySelectorAll('.fade-in-up');
    setTimeout(() => {
        fadeElements.forEach(el => el.classList.add('visible'));
    }, 800); 

    /* --- 5. Ripple Click Logic on Button --- */
    const pulseBtn = document.getElementById('pulse-btn');
    if(pulseBtn) {
        pulseBtn.addEventListener('click', function(e) {
            let rect = pulseBtn.getBoundingClientRect();
            let ripple = document.createElement('span');
            
            let size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
            ripple.className = 'ripple-span';
            
            pulseBtn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    }
});
</script>