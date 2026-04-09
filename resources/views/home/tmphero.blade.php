<style>
    /* --- Premium Midnight & Gold Hero Styles --- */
    .hero-section {
        position: relative;
        padding: 200px 0 140px;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(0, 0, 0, 0.8) 100%), 
                    url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #ffffff;
        text-align: center;
        overflow: hidden;
    }

    .hero-content {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        animation: fadeInDown 1s ease-out;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem;
        font-weight: 800;
        margin-bottom: 1.2rem;
        line-height: 1.1;
        text-shadow: 0 15px 30px rgba(0,0,0,0.6);
        background: linear-gradient(to right, #D4AF37, #FFF4D2, #D4AF37);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -1px;
    }

    /* --- PINK LOVE WORD & FLOATING HEARTS --- */
    .romantic-word {
        position: relative;
        display: inline-block;
        color: #ff758c; 
        background: none;
        -webkit-text-fill-color: #ff758c; /* Overrides the gold gradient */
    }

    /* Hearts Animation */
    .romantic-word::before,
    .romantic-word::after {
        content: '❤';
        position: absolute;
        color: #ffb6c1;
        opacity: 0;
        animation: heartFloat 3s infinite;
        pointer-events: none;
    }

    .romantic-word::before {
        top: -10px;
        right: -20px;
        font-size: 1.2rem;
        animation-delay: 0s;
    }

    .romantic-word::after {
        top: -25px;
        right: -35px;
        font-size: 0.8rem;
        animation-delay: 1.5s;
    }

    @keyframes heartFloat {
        0% { transform: translateY(10px) rotate(0deg) scale(0.5); opacity: 0; }
        50% { opacity: 0.8; }
        100% { transform: translateY(-30px) rotate(20deg) scale(1.2); opacity: 0; }
    }

    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 4rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        max-width: 750px;
        margin: 0 auto 4rem auto;
    }

    /* --- UNIQUE PILL SEARCH BAR --- */
    .unique-search-bar {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 60px;
        padding: 10px 10px 10px 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        transition: all 0.4s ease;
    }

    .unique-search-bar:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(212, 175, 55, 0.6);
    }

    .search-field {
        flex: 1;
        display: flex;
        flex-direction: column;
        text-align: left;
        padding: 5px 20px;
        border-right: 1px solid rgba(255, 255, 255, 0.15);
    }

    .search-field:last-of-type {
        border-right: none;
    }

    .search-field label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: #D4AF37;
        margin-bottom: 2px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .search-field select {
        background: transparent;
        border: none;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 500;
        outline: none;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
    }

    .search-field select option {
        color: #0f172a;
    }

    .btn-search-circle {
        background: linear-gradient(135deg, #E5C07B 0%, #D4AF37 100%);
        color: #0f172a;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
        box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
    }

    .btn-search-circle:hover {
        transform: scale(1.1) rotate(10deg);
        background: linear-gradient(135deg, #FFF4D2 0%, #E5C07B 100%);
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Mobile Responsiveness --- */
    @media (max-width: 991px) {
        .hero-title { font-size: 3.2rem; }
        .hero-section { padding: 150px 0 80px; }
        .unique-search-bar {
            flex-direction: column;
            border-radius: 24px;
            padding: 20px;
            gap: 10px;
        }
        .search-field {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0;
        }
        .btn-search-circle {
            width: 100%;
            border-radius: 12px;
            height: 50px;
            margin-top: 10px;
        }
        .btn-search-circle::after {
            content: ' Find Matches';
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
    }
</style>

<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Find Your Forever <span class="romantic-word">Love</span>
                    </h1>
                    <p class="hero-subtitle">
                        Join thousands of successful matches on India's most premium matrimonial platform. 
                        Start your journey to finding true love and lifelong happiness today.
                    </p>
                    
                    <form action="{{ route('search') ?? '#' }}" method="GET" class="unique-search-bar">
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
                        
                        <button type="submit" class="btn-search-circle" title="Search">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>