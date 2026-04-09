// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.main-navbar');
    if (header) {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
});

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Dropdown hover effect for desktop
    const dropdowns = document.querySelectorAll('.dropdown');
    
    if (window.innerWidth > 991) {
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const toggle = this.querySelector('.dropdown-toggle');
                if (toggle) {
                    const bsDropdown = new bootstrap.Dropdown(toggle);
                    bsDropdown.show();
                }
            });
            
            dropdown.addEventListener('mouseleave', function() {
                const toggle = this.querySelector('.dropdown-toggle');
                if (toggle) {
                    const bsDropdown = new bootstrap.Dropdown(toggle);
                    bsDropdown.hide();
                }
            });
        });
    }
    
    // Mobile menu close on click
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });
    
    // Active link highlighting
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPath || 
            (currentPath.includes(linkPath) && linkPath !== '/')) {
            link.classList.add('active');
        }
    });
});