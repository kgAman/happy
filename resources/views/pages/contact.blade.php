@extends('layouts.master')

@section('title', 'Contact Us - HappilyWeds Matrimony')

@push('page-styles')
<style>
    /* Contact Page Styles - Matching Home Page Design */
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
    
    /* Contact Hero Section */
    .contact-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: var(--white);
        padding: 120px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .contact-hero-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .contact-hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .contact-hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2.5rem;
        opacity: 0.9;
        line-height: 1.6;
    }
    
    /* Contact Section */
    .contact-section {
        padding: 100px 0;
        background: var(--white);
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-title h2 {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }
    
    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--gradient-pink);
        border-radius: 2px;
    }
    
    .section-title p {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto;
    }
    
    /* Contact Cards */
    .contact-card {
        background: var(--white);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: var(--shadow-soft);
        transition: var(--transition);
        height: 100%;
        border: 2px solid transparent;
        margin-bottom: 30px;
    }
    
    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hard);
        border-color: var(--primary-pink);
    }
    
    .contact-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background: var(--light-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--dark-pink);
        transition: var(--transition);
    }
    
    .contact-card:hover .contact-icon {
        background: var(--gradient-pink);
        color: var(--white);
        transform: scale(1.1);
    }
    
    .contact-card h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
    }
    
    .contact-card p {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 10px;
    }
    
    .contact-link {
        color: var(--dark-pink);
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
        transition: var(--transition);
    }
    
    .contact-link:hover {
        color: var(--primary-pink);
        transform: translateX(5px);
    }
    
    /* Contact Form */
    .contact-form-container {
        background: var(--white);
        border-radius: 20px;
        padding: 50px;
        box-shadow: var(--shadow-soft);
        margin-top: 30px;
    }
    
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }
    
    .form-group {
        margin-bottom: 0;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: var(--transition);
        background: var(--white);
    }
    
    .form-control:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 3px rgba(248, 165, 194, 0.2);
        outline: none;
    }
    
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
    
    .btn-submit {
        background: var(--gradient-pink);
        color: var(--white);
        border: none;
        padding: 16px 45px;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 200px;
        margin-top: 10px;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.3);
    }
    
    /* FAQ Section */
    .faq-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #fdeff6 0%, #f7f7f7 100%);
    }
    
    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .faq-item {
        background: var(--white);
        border-radius: 15px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        transition: var(--transition);
    }
    
    .faq-item:hover {
        box-shadow: var(--shadow-hard);
    }
    
    .faq-question {
        padding: 25px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--white);
    }
    
    .faq-question h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        flex: 1;
    }
    
    .faq-icon {
        width: 30px;
        height: 30px;
        background: var(--light-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark-pink);
        transition: var(--transition);
        flex-shrink: 0;
        margin-left: 15px;
    }
    
    .faq-answer {
        padding: 0 30px;
        max-height: 0;
        overflow: hidden;
        transition: var(--transition);
        background: var(--white);
    }
    
    .faq-answer.active {
        padding: 0 30px 25px;
        max-height: 500px;
    }
    
    .faq-answer p {
        color: var(--text-light);
        line-height: 1.6;
        margin: 0;
    }
    
    /* Map Section */
    .map-section {
        padding: 0 0 100px;
    }
    
    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-hard);
        height: 400px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
    
    /* Team Section */
    .team-section {
        padding: 100px 0;
        background: var(--white);
    }
    
    .team-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        transition: var(--transition);
        text-align: center;
        padding-bottom: 30px;
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hard);
    }
    
    .team-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    
    .team-info {
        padding: 25px;
    }
    
    .team-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .team-role {
        color: var(--dark-pink);
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .team-desc {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .contact-hero-title {
            font-size: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 991.98px) {
        .contact-hero {
            padding: 80px 0 50px;
        }
        
        .contact-hero-title {
            font-size: 2.5rem;
        }
        
        .contact-hero-subtitle {
            font-size: 1.1rem;
        }
        
        .contact-section,
        .faq-section,
        .team-section {
            padding: 80px 0;
        }
        
        .contact-form-container {
            padding: 35px;
        }
    }
    
    @media (max-width: 767.98px) {
        .contact-hero-title {
            font-size: 2rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .contact-form-container {
            padding: 25px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .btn-submit {
            width: 100%;
        }
        
        .map-container {
            height: 300px;
        }
    }
    
    @media (max-width: 575.98px) {
        .contact-hero-title {
            font-size: 1.8rem;
        }
        
        .contact-card {
            padding: 30px 20px;
        }
        
        .faq-question {
            padding: 20px;
        }
        
        .faq-question h3 {
            font-size: 1.1rem;
        }
    }
</style>
@endpush

@section('page-content')
<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-hero-content">
                    <h1 class="contact-hero-title">Get In Touch With Us</h1>
                    <p class="contact-hero-subtitle">
                        Have questions or need assistance? Our dedicated team is here to help you find your perfect match. 
                        Reach out to us anytime.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Cards Section -->
<section class="contact-section">
    <div class="container">
        <div class="section-title">
            <h2>Contact Information</h2>
            <p>Choose your preferred way to get in touch with our team</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p>Available 24/7 for urgent inquiries</p>
                    <a href="tel:+911800123456" class="contact-link">+91 1800 123 456</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p>Response within 24 hours</p>
                    <a href="mailto:support@happilyweds.com" class="contact-link">support@happilyweds.com</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Live Chat</h3>
                    <p>Instant support during business hours</p>
                    <a href="#chat" class="contact-link">Start Live Chat</a>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-form-container">
            <div class="section-title mb-5">
                <h3>Send Us a Message</h3>
                <p>Fill out the form below and we'll get back to you as soon as possible</p>
            </div>
            
            <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select class="form-control" id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="technical">Technical Support</option>
                            <option value="billing">Billing & Payment</option>
                            <option value="profile">Profile Assistance</option>
                            <option value="feedback">Feedback & Suggestions</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message *</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Please describe your inquiry in detail..." required></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p>Find quick answers to common questions</p>
        </div>
        
        <div class="faq-container">
            @foreach($faqs as $faq)
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <h3>{{ $faq['question'] }}</h3>
                    <div class="faq-icon">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>{{ $faq['answer'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="section-title">
            <h2>Visit Our Office</h2>
            <p>Come meet us in person for personalized assistance</p>
        </div>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.6837787494965!2d77.20731981508199!3d28.61433998242679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2daa9eb4d0b%3A0x717971125923e5d!2sIndia%20Gate!5e0!3m2!1sen!2sin!4v1645707432456!5m2!1sen!2sin" 
                    allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="contact-info">
                    <h4><i class="bi bi-geo-alt text-primary"></i> Head Office</h4>
                    <p>HappilyWeds Matrimony<br>
                       Level 5, Tech Park One<br>
                       New Delhi 110001, India</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <h4><i class="bi bi-clock text-primary"></i> Office Hours</h4>
                    <p>Monday - Friday: 9:00 AM - 7:00 PM<br>
                       Saturday: 10:00 AM - 4:00 PM<br>
                       Sunday: Closed</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <h4><i class="bi bi-telephone text-primary"></i> Emergency</h4>
                    <p>For urgent matters outside office hours:<br>
                       <strong>+91 98765 43210</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="section-title">
            <h2>Meet Our Support Team</h2>
            <p>Our dedicated team is here to assist you</p>
        </div>
        
        <div class="row">
            @foreach($teamMembers as $member)
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="team-image">
                    <div class="team-info">
                        <div class="team-name">{{ $member['name'] }}</div>
                        <div class="team-role">{{ $member['role'] }}</div>
                        <div class="team-desc">{{ $member['description'] }}</div>
                        <div class="team-contact">
                            <small><i class="bi bi-envelope"></i> {{ $member['email'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // FAQ Toggle Function
    function toggleFAQ(element) {
        const faqItem = element.parentElement;
        const answer = faqItem.querySelector('.faq-answer');
        const icon = element.querySelector('.faq-icon i');
        
        // Close other open FAQs
        document.querySelectorAll('.faq-answer.active').forEach(activeAnswer => {
            if (activeAnswer !== answer) {
                activeAnswer.classList.remove('active');
                const activeIcon = activeAnswer.parentElement.querySelector('.faq-icon i');
                activeIcon.className = 'bi bi-chevron-down';
            }
        });
        
        // Toggle current FAQ
        answer.classList.toggle('active');
        
        // Change icon
        if (answer.classList.contains('active')) {
            icon.className = 'bi bi-chevron-up';
        } else {
            icon.className = 'bi bi-chevron-down';
        }
    }
    
    // Form Submission
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.querySelector('.contact-form');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                // Add loading state
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
                submitBtn.disabled = true;
                
                // In real application, this would be an AJAX call
                setTimeout(() => {
                    // Simulate successful submission
                    alert('Thank you for your message! We will get back to you within 24 hours.');
                    
                    // Reset form
                    contactForm.reset();
                    
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            });
        }
        
        // Auto-open first FAQ
        const firstFaq = document.querySelector('.faq-item:first-child .faq-answer');
        if (firstFaq) {
            firstFaq.classList.add('active');
            const icon = firstFaq.parentElement.querySelector('.faq-icon i');
            if (icon) {
                icon.className = 'bi bi-chevron-up';
            }
        }
    });
</script>
@endpush