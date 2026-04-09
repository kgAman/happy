@extends('layouts.master')

@section('title', 'Search Matches | Find Your Perfect Match')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    :root {
        --primary: #e75480;
        --primary-light: rgba(231, 84, 128, 0.1);
        --primary-hover: #d6406c;
        --background: #f8f9fa;
        --card-bg: #ffffff;
        --text-main: #2d1b2e;
        --text-muted: #6b5b6b;
        --border-color: #eaeaea;
        --gold: #d4af37;
        --success: #10b981;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background);
    }

    .font-playfair { font-family: 'Playfair Display', serif; }

    /* --- WIDE CONTAINER --- */
    .search-page-container {
        width: 100%;
        max-width: 1700px; /* Expands to cover almost the whole screen on large displays */
        margin: 0 auto;
        padding: 0 2rem;
    }

    @media (max-width: 768px) {
        .search-page-container { padding: 0 1rem; }
    }

    /* --- Hero Section --- */
    .search-hero {
        position: relative;
        background-color: #1a0f1c; /* Deep plum */
        color: #ffffff;
        padding: 100px 20px; /* Made slightly taller */
        overflow: hidden;
    }

    .search-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(231, 84, 128, 0.2) 0%, transparent 100%);
        z-index: 1;
    }

    .search-hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .search-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .search-hero p {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.8);
    }

    /* --- Layout --- */
    .search-layout {
        display: flex;
        flex-direction: column;
        gap: 40px; /* Increased gap */
        padding: 40px 0 80px 0;
    }

    @media (min-width: 992px) {
        .search-layout {
            flex-direction: row;
        }
    }

    /* --- Sidebar Filters --- */
    .filters-sidebar {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        padding: 30px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    @media (min-width: 992px) {
        .filters-sidebar {
            width: 350px; /* Slightly wider sidebar */
            flex-shrink: 0;
            position: sticky;
            top: 100px;
            height: fit-content;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }
    }
    
    .filters-sidebar::-webkit-scrollbar { width: 5px; }
    .filters-sidebar::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 10px; }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .filter-header h3 {
        font-size: 1.3rem;
        margin: 0;
        color: var(--text-main);
    }

    .btn-clear {
        background: none;
        border: none;
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0;
    }

    .filter-section {
        margin-bottom: 24px;
    }

    .filter-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        cursor: pointer;
        margin-bottom: 15px;
        background: none;
        border: none;
        width: 100%;
        padding: 0;
        text-align: left;
    }

    .filter-title i {
        color: var(--text-muted);
        transition: transform 0.3s ease;
    }

    .filter-title.collapsed i {
        transform: rotate(-90deg);
    }

    .filter-content {
        max-height: 250px;
        overflow-y: auto;
        padding-right: 5px;
        transition: max-height 0.3s ease;
    }

    .filter-content.collapsed {
        max-height: 0;
        overflow: hidden;
    }

    /* Custom Checkbox Row */
    .filter-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        cursor: pointer;
    }

    .filter-row:last-child { margin-bottom: 0; }

    .filter-row input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
        cursor: pointer;
    }

    .filter-row i {
        font-size: 1.1rem;
        width: 18px;
        text-align: center;
    }

    .filter-label {
        font-size: 0.95rem;
        color: var(--text-main);
        flex-grow: 1;
        transition: color 0.2s;
    }

    .filter-row:hover .filter-label { color: var(--primary); }

    .filter-count {
        font-size: 0.75rem;
        background: var(--background);
        color: var(--text-muted);
        padding: 3px 10px;
        border-radius: 50px;
    }

    /* Range Slider */
    .range-values {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .range-values span {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        background: var(--primary-light);
        padding: 6px 14px;
        border-radius: 50px;
    }

    /* --- Results Area --- */
    .results-area {
        flex-grow: 1;
        min-width: 0; /* Prevents flex blowout */
        background: transparent; /* Removed solid background to let layout breathe */
        border-radius: 16px;
        overflow: hidden;
    }

    .results-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding: 20px 30px;
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        margin-bottom: 30px; /* Space between header and grid */
        gap: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .results-info {
        font-size: 1rem;
        color: var(--text-main);
        margin: 0;
    }

    .results-controls {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .sort-select {
        font-size: 0.95rem;
        padding: 8px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        outline: none;
        color: var(--text-main);
    }

    .sort-select:focus {
        border-color: var(--primary);
    }

    .view-toggles {
        display: flex;
        gap: 5px;
    }

    .btn-view-toggle {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-muted);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-view-toggle.active {
        background: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* --- Grid View Cards --- */
    .profiles-grid {
        display: grid;
        /* MASSIVELY INCREASED MIN-WIDTH FOR BIGGER CARDS */
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 30px; /* Bigger gaps between cards */
    }

    .card-grid {
        border-radius: 20px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        transition: all 0.3s ease;
        background: var(--card-bg);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .card-grid:hover {
        border-color: rgba(231, 84, 128, 0.4);
        box-shadow: 0 15px 40px rgba(231, 84, 128, 0.1);
        transform: translateY(-5px);
    }

    .card-img-wrapper {
        position: relative;
        height: 320px; /* INCREASED HEIGHT DRAMATICALLY */
        overflow: hidden;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card-grid:hover .card-img-wrapper img { transform: scale(1.05); }

    .card-overlay-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
    }

    .badge-absolute {
        position: absolute;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        z-index: 2;
    }

    .badge-verified { top: 15px; right: 15px; background: var(--success); color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3); }
    .badge-premium { top: 15px; left: 15px; background: var(--gold); color: white; box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3); }

    .card-img-info {
        position: absolute;
        bottom: 15px;
        left: 20px;
        right: 20px;
        color: white;
        z-index: 2;
    }

    .card-img-info h3 {
        font-size: 1.4rem; /* Larger font */
        margin: 0 0 6px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .online-dot {
        width: 10px;
        height: 10px;
        background-color: var(--success);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
    }

    .card-body-custom {
        padding: 25px; /* More breathing room */
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem; /* Larger text */
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .info-row i { color: rgba(231, 84, 128, 0.7); font-size: 1.1rem; width: 20px; text-align: center; }

    .card-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-action-sm {
        flex: 1;
        padding: 10px 0;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-view-sm { background: var(--primary-light); color: var(--primary); }
    .btn-view-sm:hover { background: var(--primary); color: white; }
    
    .btn-shortlist-sm { background: transparent; border: 1px solid var(--border-color); color: var(--text-muted); }
    .btn-shortlist-sm:hover, .btn-shortlist-sm.active { background: var(--gold); border-color: var(--gold); color: white; }

    /* --- List View Cards --- */
    .profiles-list {
        display: flex;
        flex-direction: column;
        gap: 25px; /* Space between list items */
    }

    .card-list {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
        background: var(--card-bg);
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    @media (min-width: 576px) {
        .card-list { flex-direction: row; }
    }

    .card-list:hover { 
        border-color: rgba(231, 84, 128, 0.4);
        box-shadow: 0 15px 40px rgba(231, 84, 128, 0.1);
        transform: translateY(-3px);
    }

    .card-list .list-img-wrapper {
        width: 100%;
        height: 250px;
        flex-shrink: 0;
    }

    @media (min-width: 576px) {
        .card-list .list-img-wrapper {
            width: 320px; /* INCREASED LIST IMAGE SIZE */
            height: 100%;
            min-height: 280px;
        }
    }

    .card-list .list-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-list-body {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    /* --- Pagination --- */
    .pagination-wrapper {
        padding: 20px;
        margin-top: 40px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .page-btn {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        border-radius: 10px;
        color: var(--text-main);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .page-btn:hover { border-color: var(--primary); color: var(--primary); }
    .page-btn.active { background: var(--primary); border-color: var(--primary); color: white; box-shadow: 0 5px 15px rgba(231, 84, 128, 0.3);}

    /* Main Apply Filter Button */
    .btn-apply-filters {
        width: 100%;
        background: var(--primary);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        margin-top: 25px;
        transition: background 0.3s;
        box-shadow: 0 5px 15px rgba(231, 84, 128, 0.2);
    }
    .btn-apply-filters:hover { background: var(--primary-hover); transform: translateY(-2px); }

    /* Mobile Filter Toggle */
    .btn-mobile-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 20px;
    }
    
    /* Custom Dual Range Slider */
    .custom-slider-container { position: relative; width: 100%; height: 6px; margin-top: 20px; margin-bottom: 20px; }
    .custom-slider-track { position: absolute; width: 100%; height: 6px; background-color: #e9ecef; border-radius: 4px; z-index: 1; }
    .custom-slider-range { position: absolute; height: 6px; background: linear-gradient(90deg, #f8a5c2, #e75480); border-radius: 4px; z-index: 2; }
    .custom-slider-input { position: absolute; width: 100%; height: 6px; top: 0; left: 0; -webkit-appearance: none; appearance: none; background: none; pointer-events: none; z-index: 3; margin: 0; }
    .custom-slider-input::-webkit-slider-thumb { height: 24px; width: 24px; border-radius: 50%; background: #ffffff; border: 2px solid var(--primary); pointer-events: auto; -webkit-appearance: none; box-shadow: 0 2px 8px rgba(231, 84, 128, 0.3); cursor: pointer; transition: transform 0.1s ease; }
    .custom-slider-input::-webkit-slider-thumb:hover, .custom-slider-input::-webkit-slider-thumb:active { transform: scale(1.15); background: var(--bg-blush); }
    .custom-slider-input::-moz-range-thumb { height: 24px; width: 24px; border-radius: 50%; background: #ffffff; border: 2px solid var(--primary); pointer-events: auto; box-shadow: 0 2px 8px rgba(231, 84, 128, 0.3); cursor: pointer; }
    
    @media (min-width: 992px) { .btn-mobile-filters { display: none; } }
</style>
@endpush

@section('page-content')

<section class="search-hero">
    <div class="search-hero-content">
        <h1 class="font-playfair">Find Your Perfect Match</h1>
        <p>Use our advanced search filters to find compatible partners based on your preferences</p>
    </div>
</section>

<div class="search-page-container">
    <div class="search-layout">
        
        <button class="btn-mobile-filters" onclick="toggleMobileSidebar()">
            <i class="bi bi-sliders"></i> <span id="mobileFilterText">Show Filters</span>
        </button>

        <aside class="filters-sidebar" id="filtersSidebar">
            <div class="filter-header">
                <h3 class="font-playfair">Filter Profiles</h3>
                <button class="btn-clear" onclick="clearFilters()">Clear All</button>
            </div>

            <div class="filter-section">
                <button class="filter-title" onclick="toggleSection(this)">
                    Basic <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-content">
                    <label class="filter-row">
                        <input type="checkbox" checked>
                        <i class="bi bi-patch-check text-success"></i>
                        <span class="filter-label">Verified Profiles Only</span>
                    </label>
                    <label class="filter-row">
                        <input type="checkbox">
                        <i class="bi bi-star text-warning"></i>
                        <span class="filter-label">Premium Members</span>
                    </label>
                    <label class="filter-row">
                        <input type="checkbox">
                        <i class="bi bi-wifi text-success"></i>
                        <span class="filter-label">Online Now</span>
                        <span class="filter-count">42</span>
                    </label>
                    <label class="filter-row">
                        <input type="checkbox">
                        <i class="bi bi-camera" style="color: var(--primary);"></i>
                        <span class="filter-label">With Photos</span>
                    </label>
                </div>
            </div>

    <div class="filter-section">
    <button class="filter-title" onclick="toggleSection(this)">
        Age Range <i class="bi bi-chevron-down"></i>
    </button>
    <div class="filter-content pb-2">
        <div class="range-values d-flex justify-content-between mb-3">
            <span id="ageMinLabel" class="badge rounded-pill" style="background: var(--primary-light); color: var(--primary); font-size: 0.85rem; padding: 6px 12px;">22</span>
            <span id="ageMaxLabel" class="badge rounded-pill" style="background: var(--primary-light); color: var(--primary); font-size: 0.85rem; padding: 6px 12px;">35</span>
        </div>
        
        <div class="custom-slider-container">
            <div class="custom-slider-track"></div>
            <div class="custom-slider-range" id="ageRangeBar"></div>
            <input type="range" min="18" max="60" value="22" id="ageMinInput" class="custom-slider-input">
            <input type="range" min="18" max="60" value="35" id="ageMaxInput" class="custom-slider-input">
        </div>
    </div>
</div>
 

            <div class="filter-section">
                <button class="filter-title" onclick="toggleSection(this)">
                    Religion & Caste <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-content">
                    <select class="form-select text-sm mb-2 shadow-none border-light">
                        <option>All Religions</option>
                        <option>Hindu</option>
                        <option>Muslim</option>
                        <option>Christian</option>
                        <option>Sikh</option>
                        <option>Jain</option>
                        <option>Buddhist</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>

            <div class="filter-section">
                <button class="filter-title collapsed" onclick="toggleSection(this)">
                    Education <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-content collapsed">
                    @foreach(["B.Tech/B.E.", "MBA/PGDM", "MBBS", "CA", "B.Sc", "M.Sc", "B.Com", "M.Com"] as $edu)
                    <label class="filter-row">
                        <input type="checkbox">
                        <span class="filter-label">{{ $edu }}</span>
                        <span class="filter-count">{{ rand(100, 400) }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="filter-section">
                <button class="filter-title collapsed" onclick="toggleSection(this)">
                    Profession <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-content collapsed">
                    @foreach(["Software Engineer", "Doctor", "Business", "Teacher", "Government Job", "Banking", "Lawyer"] as $prof)
                    <label class="filter-row">
                        <input type="checkbox">
                        <span class="filter-label">{{ $prof }}</span>
                        <span class="filter-count">{{ rand(50, 300) }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="filter-section">
                <button class="filter-title collapsed" onclick="toggleSection(this)">
                    Location <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-content collapsed">
                    @foreach(["Delhi/NCR", "Mumbai", "Bangalore", "Chennai", "Hyderabad"] as $loc)
                    <label class="filter-row">
                        <input type="checkbox">
                        <span class="filter-label">{{ $loc }}</span>
                        <span class="filter-count">{{ rand(500, 1500) }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <button class="btn-apply-filters">Apply Filters</button>
        </aside>
        
        <main class="results-area">
            
            <div class="results-header">
                <p class="results-info">Showing <strong style="color: var(--primary);">8</strong> of <strong style="color: var(--primary);">1,245</strong> matches</p>
                
                <div class="results-controls">
                    <label class="text-muted small mb-0 d-none d-sm-block">Sort by:</label>
                    <select class="sort-select">
                        <option>Relevance</option>
                        <option>Newest First</option>
                        <option>Most Popular</option>
                        <option>Premium First</option>
                    </select>

                    <div class="view-toggles">
                        <button class="btn-view-toggle active" id="btnGrid" onclick="switchView('grid')">
                            <i class="bi bi-grid-3x3"></i>
                        </button>
                        <button class="btn-view-toggle" id="btnList" onclick="switchView('list')">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            @php
                $displayProfiles = [
                    ['id' => 1, 'name' => 'Priya Sharma', 'age' => 28, 'height' => "5'4\"", 'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Software Engineer', 'education' => 'MCA', 'location' => 'Bangalore', 'income' => '₹ 15-20 LPA', 'religion' => 'Hindu', 'about' => 'Software professional with a passion for technology. Looking for a partner who shares similar values and life goals.', 'verified' => true, 'premium' => true, 'online' => true, 'is_shortlisted' => false],
                    ['id' => 2, 'name' => 'Raj Patel', 'age' => 32, 'height' => "5'11\"", 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Business Consultant', 'education' => 'MBA', 'location' => 'Mumbai', 'income' => '₹ 25-30 LPA', 'religion' => 'Hindu', 'about' => 'Entrepreneurial spirit with successful business ventures. Values family and looking for a life partner.', 'verified' => true, 'premium' => true, 'online' => false, 'is_shortlisted' => false],
                    ['id' => 3, 'name' => 'Anjali Reddy', 'age' => 26, 'height' => "5'3\"", 'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Doctor', 'education' => 'MBBS', 'location' => 'Hyderabad', 'income' => '₹ 12-18 LPA', 'religion' => 'Hindu', 'about' => 'Medical professional dedicated to helping others. Enjoys traveling, reading, and spending time with family.', 'verified' => true, 'premium' => false, 'online' => true, 'is_shortlisted' => false],
                    ['id' => 4, 'name' => 'Amit Kumar', 'age' => 30, 'height' => "5'10\"", 'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Civil Engineer', 'education' => 'B.Tech', 'location' => 'Delhi', 'income' => '₹ 10-15 LPA', 'religion' => 'Hindu', 'about' => 'Professional engineer with passion for architecture. Values honesty and commitment in relationships.', 'verified' => true, 'premium' => true, 'online' => false, 'is_shortlisted' => false],
                    ['id' => 5, 'name' => 'Sneha Singh', 'age' => 27, 'height' => "5'5\"", 'image' => 'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Fashion Designer', 'education' => 'B.Des', 'location' => 'Mumbai', 'income' => '₹ 8-12 LPA', 'religion' => 'Hindu', 'about' => 'Creative professional with successful fashion brand. Looking for a partner who appreciates art and culture.', 'verified' => true, 'premium' => false, 'online' => true, 'is_shortlisted' => false],
                    ['id' => 6, 'name' => 'Vikram Malhotra', 'age' => 35, 'height' => "6'0\"", 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Bank Manager', 'education' => 'MBA Finance', 'location' => 'Chennai', 'income' => '₹ 20-25 LPA', 'religion' => 'Hindu', 'about' => 'Finance professional with stable career. Enjoys cricket, reading, and family gatherings.', 'verified' => true, 'premium' => true, 'online' => false, 'is_shortlisted' => false],
                    ['id' => 7, 'name' => 'Neha Gupta', 'age' => 29, 'height' => "5'4\"", 'image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Marketing Manager', 'education' => 'MBA Marketing', 'location' => 'Delhi', 'income' => '₹ 18-22 LPA', 'religion' => 'Hindu', 'about' => 'Dynamic marketing professional with global experience. Values communication and shared interests.', 'verified' => true, 'premium' => true, 'online' => true, 'is_shortlisted' => false],
                    ['id' => 8, 'name' => 'Rahul Mehta', 'age' => 31, 'height' => "5'9\"", 'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'profession' => 'Lawyer', 'education' => 'LLB', 'location' => 'Bangalore', 'income' => '₹ 22-28 LPA', 'religion' => 'Hindu', 'about' => 'Legal professional with successful practice. Looking for a partner with strong family values.', 'verified' => true, 'premium' => false, 'online' => false, 'is_shortlisted' => false],
                ];
            @endphp

            <div class="profiles-grid" id="viewGrid">
                @foreach($displayProfiles as $profile)
                <div class="card-grid">
                    <div class="card-img-wrapper">
                        <img src="{{ $profile['image'] }}" alt="{{ $profile['name'] }}">
                        <div class="card-overlay-gradient"></div>
                        @if($profile['verified'])
                            <span class="badge-absolute badge-verified"><i class="bi bi-patch-check"></i> Verified</span>
                        @endif
                        @if($profile['premium'])
                            <span class="badge-absolute badge-premium"><i class="bi bi-star-fill"></i> Premium</span>
                        @endif
                        <div class="card-img-info">
                            <h3 class="font-playfair">
                                {{ $profile['name'] }}
                                @if($profile['online']) <span class="online-dot"></span> @endif
                            </h3>
                            <p class="small mb-0 opacity-75">{{ $profile['age'] }} years, {{ $profile['height'] }}</p>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="info-row"><i class="bi bi-briefcase"></i> <span class="text-truncate">{{ $profile['profession'] }}</span></div>
                        <div class="info-row"><i class="bi bi-mortarboard"></i> <span class="text-truncate">{{ $profile['education'] }}</span></div>
                        <div class="info-row"><i class="bi bi-geo-alt"></i> <span class="text-truncate">{{ $profile['location'] }}</span></div>
                        
                        <div class="card-actions">
                            <button class="btn-action-sm btn-view-sm" onclick="window.location.href='{{ route('profiles.show', $profile['id']) }}'">
                                <i class="bi bi-eye"></i> View
                            </button>
                            
                            <button class="btn-action-sm btn-shortlist-sm {{ ($profile['is_shortlisted'] ?? false) ? 'active' : '' }}" onclick="toggleShortlist({{ $profile['id'] }}, this)">
                                <i class="bi {{ ($profile['is_shortlisted'] ?? false) ? 'bi-star-fill' : 'bi-star' }}"></i> Shortlist
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="profiles-list" id="viewList" style="display: none;">
                @foreach($displayProfiles as $profile)
                <div class="card-list">
                    <div class="list-img-wrapper">
                        <img src="{{ $profile['image'] }}" alt="{{ $profile['name'] }}">
                    </div>
                    <div class="card-list-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="font-playfair fs-4 mb-1 d-flex align-items-center gap-2">
                                    {{ $profile['name'] }}
                                    @if($profile['online']) <span class="online-dot"></span> @endif
                                </h3>
                                <p class="text-muted small mb-0">{{ $profile['age'] }} years, {{ $profile['height'] }}, {{ $profile['religion'] }}</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if($profile['verified'])
                                    <span class="badge rounded-pill bg-success"><i class="bi bi-patch-check"></i> Verified</span>
                                @endif
                                @if($profile['premium'])
                                    <span class="badge rounded-pill bg-warning text-dark"><i class="bi bi-star-fill"></i> Premium</span>
                                @endif
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-sm-6 info-row mb-0"><i class="bi bi-briefcase"></i> <span class="text-truncate">{{ $profile['profession'] }}</span></div>
                            <div class="col-sm-6 info-row mb-0"><i class="bi bi-mortarboard"></i> <span class="text-truncate">{{ $profile['education'] }}</span></div>
                            <div class="col-sm-6 info-row mb-0"><i class="bi bi-geo-alt"></i> <span class="text-truncate">{{ $profile['location'] }}</span></div>
                        </div>

                        <p class="text-muted small mb-4 line-clamp-2">{{ $profile['about'] }}</p>

                        <div class="card-actions mt-auto" style="max-width: 300px;">
                            <button class="btn-action-sm btn-view-sm" onclick="window.location.href='{{ route('profiles.show', $profile['id']) }}'">
                                <i class="bi bi-eye"></i> View Profile
                            </button>
                            
                            <button class="btn-action-sm btn-shortlist-sm {{ ($profile['is_shortlisted'] ?? false) ? 'active' : '' }}" onclick="toggleShortlist({{ $profile['id'] }}, this)">
                                <i class="bi {{ ($profile['is_shortlisted'] ?? false) ? 'bi-star-fill' : 'bi-star' }}"></i> Shortlist
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                <button class="page-btn"><i class="bi bi-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="page-btn" style="border:none; pointer-events:none;">...</span>
                <button class="page-btn">8</button>
                <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
            </div>

        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- UI Interaction Scripts ---

    // Toggle filter sections (accordion effect)
    function toggleSection(button) {
        const content = button.nextElementSibling;
        button.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
    }
function initDualSlider() {
    const minInput = document.getElementById('ageMinInput');
    const maxInput = document.getElementById('ageMaxInput');
    const rangeBar = document.getElementById('ageRangeBar');
    const minLabel = document.getElementById('ageMinLabel');
    const maxLabel = document.getElementById('ageMaxLabel');

    function updateSlider(e) {
        let minVal = parseInt(minInput.value);
        let maxVal = parseInt(maxInput.value);

        // Prevent thumbs from crossing each other
        if (minVal >= maxVal) {
            if (e.target.id === 'ageMinInput') {
                minInput.value = maxVal - 1;
                minVal = maxVal - 1;
            } else {
                maxInput.value = minVal + 1;
                maxVal = minVal + 1;
            }
        }

        // Update UI Labels
        minLabel.innerText = minVal;
        maxLabel.innerText = maxVal;

        // Calculate percentages to draw the colored bar
        const minAttr = parseInt(minInput.min);
        const maxAttr = parseInt(minInput.max);
        
        const leftPercent = ((minVal - minAttr) / (maxAttr - minAttr)) * 100;
        const rightPercent = ((maxVal - minAttr) / (maxAttr - minAttr)) * 100;

        // Apply styles to the colored range bar
        rangeBar.style.left = leftPercent + '%';
        rangeBar.style.width = (rightPercent - leftPercent) + '%';
    }

    // Attach Event Listeners
    minInput.addEventListener('input', updateSlider);
    maxInput.addEventListener('input', updateSlider);
    
    // Initialize the bar on page load
    updateSlider({ target: { id: 'init' } });
}

// Make sure to initialize it when the page loads!
document.addEventListener('DOMContentLoaded', function() {
    initDualSlider();
});
    // Switch between Grid and List views
    function switchView(viewType) {
        const gridContainer = document.getElementById('viewGrid');
        const listContainer = document.getElementById('viewList');
        const btnGrid = document.getElementById('btnGrid');
        const btnList = document.getElementById('btnList');

        if (viewType === 'grid') {
            gridContainer.style.display = 'grid';
            listContainer.style.display = 'none';
            btnGrid.classList.add('active');
            btnList.classList.remove('active');
        } else {
            gridContainer.style.display = 'none';
            listContainer.style.display = 'flex';
            btnList.classList.add('active');
            btnGrid.classList.remove('active');
        }
    }
function toggleShortlist(profileId, button) {
        // 1. Immediately toggle the UI for a snappy user experience
        button.classList.toggle('active');
        let icon = button.querySelector('i');
        
        if (icon.classList.contains('bi-star')) {
            icon.classList.remove('bi-star');
            icon.classList.add('bi-star-fill');
        } else {
            icon.classList.remove('bi-star-fill');
            icon.classList.add('bi-star');
        }

        // 2. Send the actual request to your backend (requires the user to be logged in)
        // Matches the Route::post('/{id}/shortlist') in your web.php
        fetch(`/profiles/${profileId}/shortlist`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                // If they aren't logged in, redirect them to login
                if(response.status === 401) {
                    window.location.href = '/login';
                    throw new Error('Unauthorized');
                }
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Success! You can show a Toast notification here if you want
            console.log('Shortlist status updated!');
        })
        .catch(error => {
            if(error.message !== 'Unauthorized') {
                // If something went wrong, revert the UI back to what it was
                button.classList.toggle('active');
                icon.classList.toggle('bi-star');
                icon.classList.toggle('bi-star-fill');
                console.error('There was a problem shortlisting this profile:', error);
            }
        });
    }
    // Mobile Sidebar Toggle
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('filtersSidebar');
        const text = document.getElementById('mobileFilterText');
        
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
            text.innerText = 'Show Filters';
        } else {
            sidebar.style.display = 'block';
            text.innerText = 'Hide Filters';
        }
    }

    // Ensure sidebar is visible on desktop resize if hidden on mobile
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            document.getElementById('filtersSidebar').style.display = 'block';
        } else {
            document.getElementById('filtersSidebar').style.display = 'none';
            document.getElementById('mobileFilterText').innerText = 'Show Filters';
        }
    });

    // Handle initial state based on screen size
    if (window.innerWidth < 992) {
        document.getElementById('filtersSidebar').style.display = 'none';
    }

    // Clear filters visually
    function clearFilters() {
        const checkboxes = document.querySelectorAll('.filters-sidebar input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = false);
        
        const selects = document.querySelectorAll('.filters-sidebar select');
        selects.forEach(select => select.selectedIndex = 0);
    }
</script>
@endpush