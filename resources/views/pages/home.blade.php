@extends('layouts.master')

@section('title', 'HappilyWeds - Find Your Perfect Life Partner')

@push('page-styles')
<style>
    /* Matrimony Home Page Styles */
    :root {
        --primary-pink: #f8a5c2;
        --light-pink: #fdeff6;
        --dark-pink: #e75480;
        --gold: #d4af37;
        --light-gold: #f7efd9;
        --text-dark: #333333;
        --text-light: #666666;
        --white: #ffffff;
        --success: #10b981;
        --gradient-pink: linear-gradient(135deg, #f8a5c2, #e75480);
        --gradient-gold: linear-gradient(135deg, #d4af37, #f7efd9);
        --gradient-blue: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hard: 0 20px 40px rgba(231, 84, 128, 0.15);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Hero Section */
    .hero-section {
        /* background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover; */
        background-position: center;
        color: var(--white);
        padding: 80px 0 50px; /* Reduced from 120px 0 80px */
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-content { max-width: 800px; margin: 0 auto; position: relative; z-index: 2; }
    .hero-title { font-size: 3.5rem; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.2; }
    .hero-subtitle { font-size: 1.3rem; margin-bottom: 2.5rem; opacity: 0.9; line-height: 1.6; }
    
    /* Search Bar */
    .search-container { background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 30px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); margin-top: 40px; } /* Margin reduced */
    .search-form { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end; }
    .form-group { margin-bottom: 0; }
    .form-group label { display: block; margin-bottom: 8px; color: var(--text-dark); font-weight: 600; font-size: 0.9rem; }
    .form-select, .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: var(--transition); }
    .form-select:focus, .form-control:focus { border-color: var(--primary-pink); box-shadow: 0 0 0 3px rgba(248, 165, 194, 0.2); outline: none; }
    .btn-search { background: var(--gradient-pink); color: var(--white); border: none; padding: 14px 30px; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; gap: 10px; }
    .btn-search:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(231, 84, 128, 0.3); }
    
    /* Common Layout */
    .section-title { text-align: center; margin-bottom: 40px; } /* Reduced from 60px */
    .section-title h2 { font-size: 2.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 20px; position: relative; display: inline-block; }
    .section-title h2::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: var(--gradient-pink); border-radius: 2px; }
    .section-title p { font-size: 1.2rem; color: var(--text-light); max-width: 700px; margin: 0 auto; }
    
    /* Features Section */
    .features-section { padding: 60px 0; background: var(--white); } /* Reduced from 100px */
    .feature-card { background: var(--white); border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: var(--shadow-soft); transition: var(--transition); height: 100%; border: 2px solid transparent; }
    .feature-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-hard); border-color: var(--primary-pink); }
    .feature-icon { width: 80px; height: 80px; margin: 0 auto 25px; background: var(--light-pink); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--dark-pink); transition: var(--transition); }
    .feature-card:hover .feature-icon { background: var(--gradient-pink); color: var(--white); transform: scale(1.1); }
    .feature-card h3 { font-size: 1.4rem; font-weight: 600; color: var(--text-dark); margin-bottom: 15px; }
    .feature-card p { color: var(--text-light); line-height: 1.6; margin-bottom: 20px; }
    
    /* Profiles Section */
    .profiles-section { padding: 60px 0; background: linear-gradient(135deg, #fdeff6 0%, #f7f7f7 100%); } /* Reduced from 100px */
    .profile-card { background: var(--white); border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-soft); transition: var(--transition); margin-bottom: 30px; height: 100%; }
    .profile-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-hard); }
    .profile-image { width: 100%; height: 250px; object-fit: cover; }
    .profile-content { padding: 25px; }
    .profile-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
    .profile-name { font-size: 1.3rem; font-weight: 600; color: var(--text-dark); margin-bottom: 5px; }
    .profile-age { color: var(--text-light); font-size: 0.9rem; }
    .profile-verified { background: var(--success); color: var(--white); padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: 600; }
    .profile-details { margin-bottom: 20px; }
    .profile-detail { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; color: var(--text-light); font-size: 0.95rem; }
    .profile-detail i { color: var(--primary-pink); width: 20px; }
    .profile-actions { display: flex; gap: 10px; }
    .btn-profile { flex: 1; padding: 10px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; gap: 5px; }
    .btn-view { background: var(--light-pink); color: var(--dark-pink); }
    .btn-view:hover { background: var(--dark-pink); color: var(--white); }
    .btn-connect { background: var(--gradient-pink); color: var(--white); }
    .btn-connect:hover { opacity: 0.9; transform: translateY(-2px); }
    
    /* Stories Section */
    .stories-section { padding: 60px 0; background: var(--white); } /* Reduced from 100px */
    .story-card { background: var(--white); border-radius: 20px; padding: 40px; box-shadow: var(--shadow-soft); transition: var(--transition); height: 100%; }
    .story-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-hard); }
    .story-content { position: relative; padding-left: 40px; margin-bottom: 30px; }
    .story-content::before { content: '"'; position: absolute; left: 0; top: -20px; font-size: 4rem; color: var(--primary-pink); font-family: Georgia, serif; opacity: 0.3; }
    .story-text { font-size: 1.1rem; line-height: 1.8; color: var(--text-dark); font-style: italic; margin-bottom: 30px; }
    .story-couple { display: flex; align-items: center; gap: 20px; }
    .couple-avatar { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--light-pink); }
    .couple-info h4 { margin: 0 0 5px; color: var(--text-dark); font-weight: 600; }
    .couple-info p { margin: 0; color: var(--text-light); font-size: 0.9rem; }
    
    /* Process Section */
    .process-section { padding: 60px 0; background: linear-gradient(135deg, #fdeff6 0%, #f7f7f7 100%); } /* Reduced from 100px */
    .process-step { text-align: center; padding: 20px; position: relative; }
    .step-number { width: 60px; height: 60px; background: var(--gradient-pink); color: var(--white); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 25px; position: relative; z-index: 2; }
    .process-step h3 { font-size: 1.3rem; font-weight: 600; color: var(--text-dark); margin-bottom: 15px; }
    .process-step p { color: var(--text-light); line-height: 1.6; }
    
    /* CTA Section */
    .cta-section { padding: 60px 0; background: var(--gradient-blue); color: var(--white); text-align: center; position: relative; overflow: hidden; } /* Reduced from 100px */
    .cta-content { max-width: 700px; margin: 0 auto; position: relative; z-index: 2; }
    .cta-title { font-size: 2.8rem; font-weight: 700; margin-bottom: 20px; }
    .cta-subtitle { font-size: 1.2rem; margin-bottom: 40px; opacity: 0.9; }
    .btn-cta { background: var(--white); color: var(--dark-pink); padding: 16px 45px; border-radius: 50px; font-size: 1.1rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: var(--transition); }
    .btn-cta:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); color: var(--dark-pink); }
    
    /* Stats Section */
    .stats-section { padding: 40px 0; background: var(--white); } /* Reduced from 80px */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
    .stat-card { text-align: center; padding: 40px 20px; background: var(--light-pink); border-radius: 20px; transition: var(--transition); }
    .stat-card:hover { transform: translateY(-10px); background: var(--gradient-pink); color: var(--white); }
    .stat-card:hover .stat-number, .stat-card:hover .stat-label { color: var(--white); }
    .stat-number { font-size: 3rem; font-weight: 700; color: var(--dark-pink); margin-bottom: 10px; line-height: 1; }
    .stat-label { font-size: 1.1rem; color: var(--text-dark); font-weight: 600; }
    
    /* Responsive Design */
    @media (max-width: 1199.98px) { .hero-title { font-size: 3rem; } .section-title h2 { font-size: 2.5rem; } }
    @media (max-width: 991.98px) { 
        .hero-section { padding: 60px 0 40px; } /* Reduced */
        .hero-title { font-size: 2.5rem; } 
        .hero-subtitle { font-size: 1.1rem; } 
        .features-section, .profiles-section, .stories-section, .process-section, .cta-section { padding: 40px 0; } /* Reduced from 80px */
        .search-form { grid-template-columns: 1fr; } 
        .profile-actions { flex-direction: column; } 
    }
    @media (max-width: 767.98px) { .hero-title { font-size: 2rem; } .cta-title { font-size: 2rem; } .section-title h2 { font-size: 2rem; } .search-container { padding: 20px; margin-top: 30px; } .feature-card, .profile-card, .story-card { margin-bottom: 30px; } .stats-grid { grid-template-columns: 1fr; gap: 20px; } }
    @media (max-width: 575.98px) { .hero-title { font-size: 1.8rem; } .cta-title { font-size: 1.8rem; } .btn-cta { width: 100%; justify-content: center; } .story-card { padding: 25px; } .story-couple { flex-direction: column; text-align: center; } }
</style>
@endpush

@section('page-content')

    @include('home.hero')
    @include('home.stats')
    @include('home.features')
    @include('home.profiles')
    @include('home.process')
    @include('home.stories')
    @include('home.cta')

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number[data-count]');

        statNumbers.forEach(stat => {
            const rawValue = stat.getAttribute('data-count');
            let number = parseFloat(rawValue.replace(/[^0-9.]/g, ''));
            let suffix = rawValue.replace(/[0-9.]/g, '');

            if (rawValue.includes('K')) number *= 1000;
            if (rawValue.includes('M')) number *= 1000000;

            let current = 0;
            const duration = 2000;
            const step = number / (duration / 20);

            const updateCounter = () => {
                current += step;

                if (current < number) {
                    stat.textContent = formatNumber(Math.floor(current)) + suffix;
                    setTimeout(updateCounter, 20);
                } else {
                    stat.textContent = formatNumber(number) + suffix;
                }
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(stat);
        });

        function formatNumber(num) {
            if (num >= 1000000) return (num / 1000000).toFixed(1) + "M";
            if (num >= 1000) return (num / 1000).toFixed(0) + "K";
            return num;
        }
        
        const searchForm = document.querySelector('.search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Searching...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            });
        }
    });
    
    function viewProfile(profileId) {
        window.location.href = `/profiles/${profileId}`;
    }
    
    function connectProfile(profileId) {
        alert('Connect feature would open here. Profile ID: ' + profileId);
    }
    
</script>
@endpush