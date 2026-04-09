@extends('layouts.master')

@section('title', 'Wedding Planning Checklist | HappilyWeds')

@push('page-styles')
<style>
    /* Checklist Page Custom Styles */
    :root {
        --primary-pink: #f8a5c2;
        --light-pink: #fdeff6;
        --dark-pink: #e75480;
        --gold: #d4af37;
        --light-gold: #f7efd9;
        --text-dark: #333333;
        --text-light: #666666;
        --white: #ffffff;
        --green: #10b981;
        --gray-100: #f8f9fa;
        --gray-200: #e9ecef;
        --gradient-pink: linear-gradient(135deg, #f8a5c2, #e75480);
        --gradient-gold: linear-gradient(135deg, #d4af37, #f7efd9);
        --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hard: 0 20px 40px rgba(231, 84, 128, 0.15);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Hero Section */
    .checklist-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: var(--white);
        padding: 100px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .checklist-hero::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to bottom, transparent, var(--white));
        z-index: 1;
    }
    
    .checklist-hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .checklist-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .checklist-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
        margin-top: 3rem;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-pink);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* Checklist Controls */
    .checklist-controls {
        background: var(--white);
        padding: 30px 0;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .controls-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .progress-section {
        flex: 1;
        min-width: 300px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .progress-bar {
        height: 10px;
        background: var(--gray-200);
        border-radius: 5px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        background: var(--gradient-pink);
        border-radius: 5px;
        width: 0%;
        transition: width 1s ease;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .btn-checklist {
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        border: 2px solid transparent;
    }
    
    .btn-save {
        background: var(--gradient-pink);
        color: var(--white);
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(231, 84, 128, 0.3);
    }
    
    .btn-print {
        background: transparent;
        color: var(--dark-pink);
        border-color: var(--dark-pink);
    }
    
    .btn-print:hover {
        background: var(--dark-pink);
        color: var(--white);
        transform: translateY(-2px);
    }
    
    /* Checklist Sections */
    .checklist-sections {
        padding: 80px 0;
        background: var(--gray-100);
    }
    
    .section-card {
        background: var(--white);
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: var(--transition);
    }
    
    .section-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hard);
    }
    
    .section-header {
        background: linear-gradient(135deg, var(--light-pink), var(--white));
        padding: 25px 30px;
        border-bottom: 1px solid var(--gray-200);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .section-header h3 {
        margin: 0;
        color: var(--text-dark);
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .section-icon {
        width: 50px;
        height: 50px;
        background: var(--light-pink);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--dark-pink);
    }
    
    .section-indicator {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    .section-content {
        padding: 30px;
    }
    
    /* Task Items */
    .task-item {
        display: flex;
        align-items: flex-start;
        padding: 20px;
        border-bottom: 1px solid var(--gray-200);
        transition: var(--transition);
        position: relative;
    }
    
    .task-item:last-child {
        border-bottom: none;
    }
    
    .task-item:hover {
        background: var(--light-pink);
        border-radius: 10px;
    }
    
    .task-checkbox {
        flex-shrink: 0;
        margin-right: 20px;
        position: relative;
    }
    
    .task-checkbox input {
        width: 24px;
        height: 24px;
        cursor: pointer;
        opacity: 0;
        position: absolute;
        z-index: 2;
    }
    
    .checkmark {
        width: 24px;
        height: 24px;
        border: 2px solid var(--gray-200);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        position: relative;
        background: var(--white);
    }
    
    .task-checkbox input:checked ~ .checkmark {
        background: var(--green);
        border-color: var(--green);
    }
    
    .checkmark::after {
        content: '✓';
        color: var(--white);
        font-size: 14px;
        font-weight: bold;
        opacity: 0;
        transform: scale(0);
        transition: var(--transition);
    }
    
    .task-checkbox input:checked ~ .checkmark::after {
        opacity: 1;
        transform: scale(1);
    }
    
    .task-content {
        flex: 1;
    }
    
    .task-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .task-completed .task-title {
        text-decoration: line-through;
        color: var(--text-light);
    }
    
    .task-description {
        color: var(--text-light);
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 12px;
    }
    
    .task-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .task-date, .task-priority {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
        color: var(--text-light);
    }
    
    .priority-high {
        color: #ef4444;
        font-weight: 600;
    }
    
    .priority-medium {
        color: #f59e0b;
        font-weight: 600;
    }
    
    .priority-low {
        color: var(--green);
        font-weight: 600;
    }
    
    .task-actions {
        display: flex;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .task-item:hover .task-actions {
        opacity: 1;
    }
    
    .task-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: var(--white);
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .task-action-btn:hover {
        background: var(--dark-pink);
        color: var(--white);
        transform: translateY(-2px);
    }
    
    /* Timeline Section */
    .timeline-section {
        padding: 80px 0;
        background: var(--white);
    }
    
    .timeline-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
    }
    
    .timeline-container::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--light-pink);
        border-radius: 2px;
    }
    
    .timeline-item {
        display: flex;
        margin-bottom: 40px;
        position: relative;
    }
    
    .timeline-icon {
        width: 60px;
        height: 60px;
        background: var(--white);
        border: 4px solid var(--light-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--dark-pink);
        z-index: 2;
        flex-shrink: 0;
        margin-right: 30px;
    }
    
    .timeline-content {
        background: var(--gray-100);
        border-radius: 15px;
        padding: 25px;
        flex: 1;
        box-shadow: var(--shadow-soft);
    }
    
    .timeline-content h4 {
        color: var(--text-dark);
        margin-bottom: 10px;
        font-size: 1.3rem;
    }
    
    .timeline-date {
        display: inline-block;
        padding: 5px 15px;
        background: var(--light-pink);
        color: var(--dark-pink);
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    /* Tips Section */
    .tips-section {
        padding: 80px 0;
        background: var(--gray-100);
    }
    
    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .tip-card {
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-soft);
        transition: var(--transition);
    }
    
    .tip-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hard);
    }
    
    .tip-icon {
        width: 60px;
        height: 60px;
        background: var(--light-pink);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--dark-pink);
        margin-bottom: 20px;
    }
    
    .tip-card h4 {
        color: var(--text-dark);
        margin-bottom: 15px;
        font-size: 1.2rem;
    }
    
    .tip-card p {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .tip-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .tip-tag {
        background: var(--light-pink);
        color: var(--dark-pink);
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    /* Download Section */
    .download-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8a5c2, #e75480);
        color: var(--white);
        text-align: center;
    }
    
    .download-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        padding: 50px;
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .download-card h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    
    .download-card p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 30px;
    }
    
    .download-options {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .btn-download {
        padding: 15px 35px;
        background: var(--white);
        color: var(--dark-pink);
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
    }
    
    .btn-download:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .checklist-hero h1 {
            font-size: 3rem;
        }
        
        .controls-container {
            flex-direction: column;
            align-items: stretch;
        }
    }
    
    @media (max-width: 991.98px) {
        .checklist-hero {
            padding: 80px 0 40px;
        }
        
        .checklist-hero h1 {
            font-size: 2.5rem;
        }
        
        .checklist-sections,
        .timeline-section,
        .tips-section,
        .download-section {
            padding: 60px 0;
        }
        
        .timeline-container::before {
            left: 25px;
        }
        
        .timeline-icon {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }
    }
    
    @media (max-width: 767.98px) {
        .checklist-hero h1 {
            font-size: 2rem;
        }
        
        .checklist-hero p {
            font-size: 1rem;
        }
        
        .hero-stats {
            gap: 20px;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .section-header {
            padding: 20px;
        }
        
        .section-header h3 {
            font-size: 1.3rem;
        }
        
        .section-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
        
        .section-content {
            padding: 20px;
        }
        
        .task-item {
            flex-direction: column;
            gap: 15px;
        }
        
        .task-checkbox {
            align-self: flex-start;
        }
        
        .timeline-container::before {
            display: none;
        }
        
        .timeline-item {
            flex-direction: column;
            gap: 20px;
        }
        
        .timeline-icon {
            margin-right: 0;
        }
        
        .download-card {
            padding: 30px 20px;
        }
        
        .download-card h2 {
            font-size: 2rem;
        }
        
        .download-options {
            flex-direction: column;
        }
        
        .btn-download {
            justify-content: center;
        }
    }
    
    @media (max-width: 575.98px) {
        .checklist-hero h1 {
            font-size: 1.8rem;
        }
        
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-checklist {
            justify-content: center;
        }
        
        .task-meta {
            flex-direction: column;
            gap: 10px;
        }
        
        .tip-card {
            padding: 20px;
        }
    }
    
    /* Print Styles */
    @media print {
        .checklist-controls,
        .btn-print,
        .timeline-section,
        .tips-section,
        .download-section,
        footer,
        header {
            display: none !important;
        }
        
        .checklist-hero {
            padding: 40px 0 20px;
            background: none;
            color: #000;
        }
        
        .checklist-hero::before {
            display: none;
        }
        
        .section-card {
            box-shadow: none;
            border: 1px solid #ddd;
            break-inside: avoid;
        }
        
        .task-item {
            break-inside: avoid;
        }
        
        .checkmark {
            border-color: #000 !important;
        }
        
        .task-checkbox input:checked ~ .checkmark {
            background: #000 !important;
        }
    }
</style>
@endpush

@section('page-content')
<!-- Hero Section -->
<section class="checklist-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checklist-hero-content">
                    <h1>Your Complete Wedding Planning Checklist</h1>
                    <p>
                        Never miss a detail with our comprehensive wedding planning checklist. 
                        From the engagement to the honeymoon, we've got every task covered to 
                        make your wedding planning journey smooth and stress-free.
                    </p>
                    
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">150+</div>
                            <div class="stat-label">Essential Tasks</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">12-18</div>
                            <div class="stat-label">Months Timeline</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Peace of Mind</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checklist Controls -->
<section class="checklist-controls">
    <div class="container">
        <div class="controls-container">
            <div class="progress-section">
                <div class="progress-label">
                    <span>Overall Progress</span>
                    <span id="progress-percentage">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn-checklist btn-save" onclick="saveChecklist()">
                    <i class="bi bi-cloud-arrow-up"></i> Save Progress
                </button>
                <button class="btn-checklist btn-print" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print Checklist
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Checklist Sections -->
<section class="checklist-sections">
    <div class="container">
        <!-- 12-18 Months Before -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-calendar-heart"></i>
                    </div>
                    <span>12-18 Months Before: Engagement & Vision</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">8</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="engagement">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task1" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Announce Your Engagement
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Share the happy news with family and friends. Consider engagement photos for announcements.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 12-18</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
                
                <div class="task-item" data-section="engagement">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task2" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Determine Your Budget
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Discuss with family about contributions and set a realistic overall budget.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 12-18</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
                
                <div class="task-item" data-section="engagement">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task3" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Create Guest List
                            <span class="task-priority priority-medium">Medium Priority</span>
                        </div>
                        <div class="task-description">
                            Draft your initial guest list to determine venue size requirements.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 12-18</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>Medium Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 9-11 Months Before -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <span>9-11 Months Before: Venue & Vendors</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">12</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="venue">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task4" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Book Ceremony & Reception Venues
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Visit and book your ceremony and reception venues. Consider date flexibility.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 9-11</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
                
                <div class="task-item" data-section="venue">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task5" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Hire Wedding Planner
                            <span class="task-priority priority-medium">Medium Priority</span>
                        </div>
                        <div class="task-description">
                            If using a wedding planner, book them early to help with vendor selection.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 9-11</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>Medium Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 6-8 Months Before -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-camera"></i>
                    </div>
                    <span>6-8 Months Before: Attire & Photography</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">10</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="attire">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task6" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Shop for Wedding Dress & Attire
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Start shopping for wedding dress and groom's attire. Allow time for alterations.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 6-8</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 3-5 Months Before -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <span>3-5 Months Before: Invitations & Details</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">15</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="invitations">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task7" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Order Invitations
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Finalize and order wedding invitations, save-the-dates, and other stationery.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 3-5</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 1-2 Months Before -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <span>1-2 Months Before: Final Touches</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">20</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="final">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task8" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Send Invitations
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Mail invitations 6-8 weeks before wedding. Track RSVPs.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Months 1-2</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Week Of -->
        <div class="section-card">
            <div class="section-header" onclick="toggleSection(this)">
                <h3>
                    <div class="section-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <span>Week Of: Last Minute Details</span>
                </h3>
                <div class="section-indicator">
                    <span class="completed-count">0</span>/<span class="total-count">25</span> completed
                </div>
            </div>
            
            <div class="section-content">
                <div class="task-item" data-section="weekof">
                    <div class="task-checkbox">
                        <input type="checkbox" id="task9" onchange="updateProgress()">
                        <span class="checkmark"></span>
                    </div>
                    <div class="task-content">
                        <div class="task-title">
                            Final Confirmations
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <div class="task-description">
                            Confirm all vendor details, timelines, and deliveries.
                        </div>
                        <div class="task-meta">
                            <div class="task-date">
                                <i class="bi bi-calendar"></i>
                                <span>Week Of</span>
                            </div>
                            <div class="task-priority">
                                <i class="bi bi-flag"></i>
                                <span>High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn" title="Add Note">
                            <i class="bi bi-sticky"></i>
                        </button>
                        <button class="task-action-btn" title="Set Reminder">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="timeline-section">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Wedding Planning Timeline</h2>
            <p>Follow this timeline to stay on track with your planning</p>
        </div>
        
        <div class="timeline-container">
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">12-18 Months Before</div>
                    <h4>Vision & Budget</h4>
                    <p>Set your budget, determine guest count, and start envisioning your perfect day.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">9-11 Months Before</div>
                    <h4>Venue & Vendors</h4>
                    <p>Book your ceremony and reception venues, plus key vendors like photographer and caterer.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-camera"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">6-8 Months Before</div>
                    <h4>Attire & Details</h4>
                    <p>Shop for wedding attire, book remaining vendors, and plan your ceremony details.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">3-5 Months Before</div>
                    <h4>Invitations & Stationery</h4>
                    <p>Order invitations, plan honeymoon, and schedule dress fittings.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">1-2 Months Before</div>
                    <h4>Final Touches</h4>
                    <p>Send invitations, finalize menu, obtain marriage license, and create seating chart.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-date">Week Of</div>
                    <h4>Last Minute Details</h4>
                    <p>Confirm all details, pack for honeymoon, and get ready to celebrate!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tips Section -->
<section class="tips-section">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Expert Planning Tips</h2>
            <p>Professional advice to make your planning journey smoother</p>
        </div>
        
        <div class="tips-grid">
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h4>Budget Smartly</h4>
                <p>Allocate 50% of your budget to venue, catering, and rentals. Save 5-10% for unexpected expenses.</p>
                <div class="tip-tags">
                    <span class="tip-tag">Budget</span>
                    <span class="tip-tag">Planning</span>
                </div>
            </div>
            
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>Guest List Strategy</h4>
                <p>Create A, B, and C lists. Send invitations to A list first, then fill spots from B list if needed.</p>
                <div class="tip-tags">
                    <span class="tip-tag">Guests</span>
                    <span class="tip-tag">Organization</span>
                </div>
            </div>
            
            <div class="tip-card">
                <div class="tip-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <h4>Timing is Everything</h4>
                <p>Book popular venues and vendors 12-18 months in advance, especially for peak wedding seasons.</p>
                <div class="tip-tags">
                    <span class="tip-tag">Timeline</span>
                    <span class="tip-tag">Vendors</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Download Section -->
<section class="download-section">
    <div class="container">
        <div class="download-card">
            <h2>Download Your Checklist</h2>
            <p>
                Get a printable PDF version of this checklist to share with your partner, 
                family, or wedding planner. Includes bonus planning worksheets and budget templates.
            </p>
            <div class="download-options">
                <a href="#" class="btn-download">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF Checklist
                </a>
                <a href="#" class="btn-download">
                    <i class="bi bi-google"></i> Save to Google Sheets
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize checklist from localStorage
        loadChecklist();
        
        // Calculate initial progress
        updateProgress();
        
        // Initialize section toggles
        initSections();
    });
    
    // Toggle section visibility
    function toggleSection(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.section-icon i');
        
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.classList.remove('bi-chevron-down');
            icon.classList.add('bi-chevron-up');
        } else {
            content.style.display = 'none';
            icon.classList.remove('bi-chevron-up');
            icon.classList.add('bi-chevron-down');
        }
    }
    
    function initSections() {
        // Add chevron icons to section headers
        document.querySelectorAll('.section-header').forEach(header => {
            const icon = header.querySelector('.section-icon i');
            icon.classList.remove('bi-calendar-heart', 'bi-building', 'bi-camera', 'bi-envelope', 'bi-check-circle', 'bi-calendar-event');
            icon.classList.add('bi-chevron-down');
            
            // Show all sections by default
            const content = header.nextElementSibling;
            content.style.display = 'block';
        });
    }
    
    // Update progress bar and counts
    function updateProgress() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const completed = document.querySelectorAll('input[type="checkbox"]:checked');
        
        // Update overall progress
        const totalTasks = checkboxes.length;
        const completedTasks = completed.length;
        const percentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0;
        
        document.getElementById('progress-percentage').textContent = `${percentage}%`;
        document.getElementById('progress-fill').style.width = `${percentage}%`;
        
        // Update section counts
        document.querySelectorAll('.section-card').forEach(section => {
            const sectionCheckboxes = section.querySelectorAll('input[type="checkbox"]');
            const sectionCompleted = section.querySelectorAll('input[type="checkbox"]:checked');
            
            const completedCount = section.querySelector('.completed-count');
            const totalCount = section.querySelector('.total-count');
            
            if (completedCount && totalCount) {
                completedCount.textContent = sectionCompleted.length;
                totalCount.textContent = sectionCheckboxes.length;
            }
            
            // Update task styling
            section.querySelectorAll('.task-item').forEach(task => {
                const checkbox = task.querySelector('input[type="checkbox"]');
                if (checkbox && checkbox.checked) {
                    task.classList.add('task-completed');
                } else {
                    task.classList.remove('task-completed');
                }
            });
        });
        
        // Save progress automatically
        saveChecklist(false);
    }
    
    // Save checklist to localStorage
    function saveChecklist(showAlert = true) {
        const checklistData = {};
        document.querySelectorAll('input[type="checkbox"]').forEach((checkbox, index) => {
            checklistData[checkbox.id] = checkbox.checked;
        });
        
        localStorage.setItem('weddingChecklist', JSON.stringify(checklistData));
        
        if (showAlert) {
            showNotification('success', 'Checklist progress saved successfully!');
        }
    }
    
    // Load checklist from localStorage
    function loadChecklist() {
        const savedData = localStorage.getItem('weddingChecklist');
        if (savedData) {
            const checklistData = JSON.parse(savedData);
            
            Object.keys(checklistData).forEach(taskId => {
                const checkbox = document.getElementById(taskId);
                if (checkbox) {
                    checkbox.checked = checklistData[taskId];
                }
            });
        }
    }
    
    // Clear all progress
    function clearProgress() {
        if (confirm('Are you sure you want to clear all progress? This cannot be undone.')) {
            localStorage.removeItem('weddingChecklist');
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            updateProgress();
            showNotification('info', 'All progress has been cleared.');
        }
    }
    
    // Add new task (demo function)
    function addNewTask(section) {
        const sectionContent = document.querySelector(`[data-section="${section}"]`).closest('.section-content');
        const newTaskId = 'task' + Date.now();
        
        const newTask = document.createElement('div');
        newTask.className = 'task-item';
        newTask.innerHTML = `
            <div class="task-checkbox">
                <input type="checkbox" id="${newTaskId}" onchange="updateProgress()">
                <span class="checkmark"></span>
            </div>
            <div class="task-content">
                <div class="task-title">
                    <input type="text" placeholder="Enter task title" class="task-title-input" 
                           style="border: none; background: transparent; font-size: 1.1rem; font-weight: 600; width: 100%;">
                    <select class="task-priority-select" style="border: 1px solid #ddd; border-radius: 4px; padding: 2px 8px;">
                        <option value="high">High Priority</option>
                        <option value="medium">Medium Priority</option>
                        <option value="low">Low Priority</option>
                    </select>
                </div>
                <div class="task-description">
                    <textarea placeholder="Add description..." 
                              style="width: 100%; border: 1px solid #ddd; border-radius: 4px; padding: 8px; font-size: 0.95rem;" 
                              rows="2"></textarea>
                </div>
            </div>
            <div class="task-actions">
                <button class="task-action-btn" onclick="saveNewTask(this)" title="Save Task">
                    <i class="bi bi-check"></i>
                </button>
                <button class="task-action-btn" onclick="cancelNewTask(this)" title="Cancel">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
        
        sectionContent.appendChild(newTask);
    }
    
    function saveNewTask(button) {
        const taskItem = button.closest('.task-item');
        const titleInput = taskItem.querySelector('.task-title-input');
        const descriptionTextarea = taskItem.querySelector('textarea');
        const prioritySelect = taskItem.querySelector('.task-priority-select');
        
        if (titleInput.value.trim() === '') {
            alert('Please enter a task title');
            return;
        }
        
        // Create permanent task
        taskItem.innerHTML = `
            <div class="task-checkbox">
                <input type="checkbox" id="task_custom_${Date.now()}" onchange="updateProgress()">
                <span class="checkmark"></span>
            </div>
            <div class="task-content">
                <div class="task-title">
                    ${titleInput.value}
                    <span class="task-priority priority-${prioritySelect.value}">${prioritySelect.options[prioritySelect.selectedIndex].text}</span>
                </div>
                <div class="task-description">
                    ${descriptionTextarea.value || 'No description provided'}
                </div>
                <div class="task-meta">
                    <div class="task-date">
                        <i class="bi bi-calendar"></i>
                        <span>Custom Task</span>
                    </div>
                </div>
            </div>
            <div class="task-actions">
                <button class="task-action-btn" title="Edit Task">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="task-action-btn" title="Delete Task" onclick="deleteTask(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        
        updateProgress();
        showNotification('success', 'New task added successfully!');
    }
    
    function cancelNewTask(button) {
        button.closest('.task-item').remove();
    }
    
    function deleteTask(button) {
        if (confirm('Are you sure you want to delete this task?')) {
            button.closest('.task-item').remove();
            updateProgress();
            showNotification('info', 'Task deleted.');
        }
    }
    
    // Notification function
    function showNotification(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        `;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;
        
        document.body.appendChild(alert);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (alert.parentElement) {
                alert.remove();
            }
        }, 5000);
    }
</script>
@endpush
