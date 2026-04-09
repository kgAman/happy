// Footer interactions and animations
document.addEventListener('DOMContentLoaded', function() {
    
    // Back to Top Button
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if (backToTopBtn) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.style.opacity = '1';
                backToTopBtn.style.visibility = 'visible';
                backToTopBtn.style.transform = 'translateY(0)';
            } else {
                backToTopBtn.style.opacity = '0';
                backToTopBtn.style.visibility = 'hidden';
                backToTopBtn.style.transform = 'translateY(10px)';
            }
        });
        
        // Scroll to top when clicked
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter form validation
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            const emailInput = this.querySelector('input[type="email"]');
            const privacyCheck = this.querySelector('#privacyCheck');
            
            if (!privacyCheck.checked) {
                e.preventDefault();
                alert('Please agree to the privacy policy to subscribe.');
                privacyCheck.focus();
                return;
            }
            
            if (!emailInput.value || !isValidEmail(emailInput.value)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                emailInput.focus();
                return;
            }
            
            // Show success message
            showNewsletterSuccess(e, this);
        });
    }
    
    // Smooth scroll for footer links
    const footerLinks = document.querySelectorAll('.footer-links a, .legal-link');
    
    footerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Social link animation
    const socialLinks = document.querySelectorAll('.social-link');
    
    socialLinks.forEach((link, index) => {
        link.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Award items hover effect
    const awardItems = document.querySelectorAll('.award-item');
    
    awardItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.2}s`;
    });
    
    // Lazy load animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);
        
        // Observe footer sections for animation
        const footerSections = document.querySelectorAll('.footer-brand, .footer-heading');
        footerSections.forEach(section => observer.observe(section));
    }
    
    // Add CSS for animations
    const footerAnimationStyles = `
        .footer-brand, .footer-heading, .footer-links li {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .footer-brand.animated, 
        .footer-heading.animated, 
        .footer-links li.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        .back-to-top {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }
    `;
    
    // Add styles to document
    const styleSheet = document.createElement('style');
    styleSheet.textContent = footerAnimationStyles;
    document.head.appendChild(styleSheet);
    
    // Helper functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function showNewsletterSuccess(event, form) {
        event.preventDefault();
        
        // Create success message
        const successMessage = document.createElement('div');
        successMessage.className = 'alert alert-success mt-3';
        successMessage.innerHTML = `
            <i class="bi bi-check-circle me-2"></i>
            Thank you for subscribing! Check your email for confirmation.
        `;
        
        // Insert after form
        form.parentNode.insertBefore(successMessage, form.nextSibling);
        
        // Reset form
        form.reset();
        
        // Remove message after 5 seconds
        setTimeout(() => {
            successMessage.remove();
        }, 5000);
        
        // In a real app, you would send the data to your server here
        // Example with Fetch API:
        /*
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Handle response
        });
        */
    }
});