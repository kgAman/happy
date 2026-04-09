<nav class="navbar navbar-expand-lg main-navbar {{ !Request::is('/') ? 'inner-page-nav' : '' }}">
    <div class="container">
        <a class="navbar-brand text-decoration-none" href="/">
            <div class="logo-wrapper">
                <span class="logo-text">HappilyWeds</span>
                <span class="logo-tagline">Matrimony & Matchmaking</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                        <i class="bi bi-house-door d-lg-none me-2"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('search*') ? 'active' : '' }}" href="/search">
                        <i class="bi bi-search d-lg-none me-2"></i>Search
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('success-stories*') ? 'active' : '' }}" href="/success-stories">
                        <i class="bi bi-heart d-lg-none me-2"></i>Success Stories
                    </a>
                </li>
                
                @auth
    <li class="nav-item dropdown ms-lg-3">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
           data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-1"></i> My Account
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
            
            {{-- Admin, Developer, and Operator Dashboard Routing Logic --}}
            @if(auth()->user()->hasAnyRole(['Admin', 'Super Admin', 'Developer', 'Operator']) || auth()->user()->isAdmin())
                <li>
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                    </a>
                </li>
            @else
                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                <li><a class="dropdown-item" href="/profile/edit"><i class="bi bi-person me-2"></i>My Profile</a></li>
                <li><a class="dropdown-item" href="/matches"><i class="bi bi-heart me-2"></i>My Matches</a></li>
            @endif
            
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item ms-lg-3 mb-2 mb-lg-0 mt-3 mt-lg-0">
        <a class="nav-link nav-login text-center" href="{{ route('login') }}">
            Login
        </a>
    </li>
    <li class="nav-item ms-lg-2">
        <a class="btn btn-primary w-100" href="{{ route('register') }}">
            Register Free
        </a>
    </li>
@endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* --- Navbar Base Styles (STATIC) --- */
.main-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1030;
    padding: 15px 0;
    transition: all 0.3s ease; 
    
    /* Initial Transparent State */
    background-color: transparent;
    box-shadow: none;
    backdrop-filter: none;
}

/* --- Scrolled State (Added via JS) --- */
.main-navbar.scrolled {
    background-color: #ffffff;
    box-shadow: 0 4px 20px rgba(231, 84, 128, 0.08);
    backdrop-filter: blur(10px);
    padding: 10px 0; 
}

/* --- Logo Styling --- */
.logo-wrapper {
    display: flex;
    flex-direction: column;
    line-height: 1.1;
}

.logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 800;
    color: #e75480;
}

.logo-tagline {
    font-family: 'Poppins', sans-serif;
    font-size: 0.75rem;
    font-weight: 400;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #f06292;
}

/* --- Navigation Links --- */
.main-navbar .nav-link {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 0.95rem;
    color: #4a2333 !important; /* Default dark plum for Home */
    margin: 0 5px;
    padding: 8px 12px;
    position: relative;
    transition: color 0.3s ease;
}

/* --- Inner Page Nav Links Override --- */
.main-navbar.inner-page-nav .nav-link {
    color: #e75480 !important; /* Matrimony Pink for all non-home pages */
}

/* Hover */
.main-navbar .nav-link:hover {
    color: #e75480 !important;
}

/* Underline Animation */
.main-navbar .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background-color: #e75480;
    transition: width 0.3s ease;
}

.main-navbar .nav-link:hover::after,
.main-navbar .nav-link.active::after {
    width: 70%;
}

/* --- Primary Button --- */
.main-navbar .btn-primary {
    background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
    color: #ffffff;
    border: none;
    border-radius: 30px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.main-navbar .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 117, 140, 0.4);
    color: #ffffff;
}

/* --- Login Button --- */
.main-navbar .nav-login {
    font-weight: 600;
    border: 2px solid #e75480;
    border-radius: 30px;
    padding: 8px 20px !important;
    color: #e75480 !important;
    transition: all 0.3s ease;
}

.main-navbar .nav-login:hover {
    background-color: rgba(231, 84, 128, 0.05);
}

.main-navbar .nav-login::after {
    display: none;
}

/* --- Dropdown --- */
.dropdown-menu {
    border-radius: 12px;
    border: 1px solid rgba(231, 84, 128, 0.1);
}

.dropdown-item:hover {
    background-color: #fdeff6;
    color: #e75480;
}

/* --- Mobile --- */
@media (max-width: 991px) {
    .navbar-collapse {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(231, 84, 128, 0.1);
        margin-top: 15px;
    }
}
</style>

<script>
// --- Navbar Scroll Logic ---
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.main-navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
</script>