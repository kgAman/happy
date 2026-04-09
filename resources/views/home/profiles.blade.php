<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    /* --- Featured Profiles Section --- */
    .profiles-section {
        padding: 100px 0;
        background-color: #fffafb; 
        font-family: 'Poppins', sans-serif;
    }

    /* Section Header */
    .profiles-section .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .profiles-section .section-title::before {
        display: inline-block;
        color: #e75480;
        font-size: 0.85rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 12px;
    }

    .profiles-section .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #2d1b2e;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .profiles-section .section-title p {
        color: #6b5b6b;
        font-size: 1.1rem;
    }

    /* --- Profile Card --- */
    .profile-card {
        background: #ffffff;
        border-radius: 16px; /* Slightly smaller border radius */
        overflow: hidden;
        border: 1px solid rgba(231, 84, 128, 0.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(231, 84, 128, 0.12);
        border-color: rgba(231, 84, 128, 0.2);
    }

    /* Image Wrapper & Zoom Effect */
    .profile-card .image-wrapper {
        position: relative !important; 
        height: 180px; /* Reduced height to match reference image */
        overflow: hidden;
        background-color: #faedf2; 
    }

    .profile-card .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease;
    }

    .profile-card:hover .profile-image {
        transform: scale(1.1); 
    }

    /* Guest Login Overlay */
    .blur-image {
        filter: blur(8px);
        transform: scale(1.1); 
    }



    .login-overlay .btn-primary {
        background: #e75480;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(231, 84, 128, 0.3);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-overlay .btn-primary:hover {
        background: #d6406c;
        transform: scale(1.05);
    }

    /* --- Card Content --- */
    .profile-content {
        padding: 16px 20px; /* Reduced padding */
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .profile-header {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }

    .name-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .profile-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem; 
        font-weight: 700;
        color: #2d1b2e;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile-verified {
        color: #e75480;
        font-size: 1rem;
        background: rgba(231, 84, 128, 0.1);
        width: 24px; /* Smaller badge */
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-age {
        font-size: 0.85rem;
        color: #6b5b6b;
    }

    /* Card Details List */
    .profile-details {
        margin-bottom: 20px; /* Reduced margin */
        display: flex;
        flex-direction: column;
        gap: 8px; /* Reduced gap */
    }

    .profile-detail {
        display: flex;
        align-items: center;
        gap: 10px; /* Reduced gap */
        color: #4a5568; /* Slightly darker text for readability */
        font-size: 0.85rem; /* Smaller text */
    }

    .profile-detail i {
        color: rgba(231, 84, 128, 0.8);
        font-size: 1rem;
        width: 16px;
        text-align: center;
    }

    .profile-detail span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* --- Card Actions (Buttons) --- */
    .profile-actions {
        display: flex;
        gap: 10px;
        margin-top: auto; 
    }

    .btn-profile {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px; /* Smaller padding */
        border-radius: 8px; /* Less rounded to match image */
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-view {
        background-color: #faedf2; /* Soft pink background */
        color: #e75480;
    }

    .btn-view:hover {
        background-color: rgba(231, 84, 128, 0.2);
    }

    .btn-connect {
        background-color: #e75480;
        color: #ffffff;
    }

    .btn-connect:hover {
        background-color: #d6406c;
    }

    /* --- View All Button (Bottom) --- */
    .profiles-section .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 30px;
        border: 2px solid rgba(231, 84, 128, 0.2);
        border-radius: 50px;
        color: #2d1b2e;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        background: transparent;
        margin-top: 15px;
    }

    .profiles-section .btn-cta:hover {
        border-color: rgba(231, 84, 128, 0.5);
        background: rgba(231, 84, 128, 0.05);
        color: #e75480;
    }
</style>

<section class="profiles-section">
    <div class="container">
        <div class="section-title">
            <h2>Featured Profiles</h2>
            <p>Meet some of our most compatible members</p>
        </div>
        
        <div class="row g-4">
            @if(isset($featuredProfiles))
                @foreach($featuredProfiles as $profile)
                <div class="col-lg-3 col-md-6">
                    <div class="profile-card">
                        <div class="image-wrapper">
                            <img src="{{ $profile['image'] }}" alt="{{ $profile['name'] }}" class="profile-image {{ auth()->check() ? '' : 'blur-image' }}">
                            @guest
                            <div class="login-overlay">
                                <a href="{{ route('login') ?? '#' }}" class="btn btn-primary btn-sm">
                                    Login to view
                                </a>
                            </div>
                            @endguest
                        </div>
                        
                        <div class="profile-content">
                            <div class="profile-header">
                                <div class="name-wrapper">
                                    <div class="profile-name">{{ $profile['name'] }}</div>
                                    @if(isset($profile['verified']) && $profile['verified'])
                                    <div class="profile-verified">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="profile-age">{{ $profile['age'] }} years</div>
                            </div>
                            
                            <div class="profile-details">
                                <div class="profile-detail">
                                    <i class="bi bi-briefcase"></i>
                                    <span>{{ $profile['profession'] ?? 'N/A' }}</span>
                                </div>
                                <div class="profile-detail">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $profile['location'] ?? 'N/A' }}</span>
                                </div>
                                <div class="profile-detail">
                                    <i class="bi bi-mortarboard"></i>
                                    <span>{{ $profile['education'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                            
                            <div class="profile-actions">
                                <button class="btn-profile btn-view" onclick="viewProfile({{ $profile['id'] }})">
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <button class="btn-profile btn-connect" onclick="connectProfile({{ $profile['id'] }})">
                                    <i class="bi bi-heart"></i> Connect
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('search') ?? '#' }}" class="btn-cta">
                <i class="bi bi-people"></i> View All Profiles
            </a>
        </div>
    </div>
</section>