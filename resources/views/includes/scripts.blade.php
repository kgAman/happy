<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('public/js/header.js') }}"></script>
<script src="{{ asset('public/js/footer.js') }}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>

<!-- SweetAlert2 for notifications -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Vanilla JavaScript CSRF token setup
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Override fetch to include CSRF token
        const originalFetch = window.fetch;
        window.fetch = function(url, options = {}) {
            if (typeof options.headers === 'undefined') {
                options.headers = {};
            }
            if (csrfToken && !options.headers['X-CSRF-TOKEN']) {
                options.headers['X-CSRF-TOKEN'] = csrfToken;
            }
            return originalFetch(url, options);
        };
        
        // For XMLHttpRequest
        const originalSend = XMLHttpRequest.prototype.send;
        XMLHttpRequest.prototype.send = function(body) {
            if (csrfToken && !this._csrfTokenAdded) {
                this.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                this._csrfTokenAdded = true;
            }
            originalSend.call(this, body);
        };
    });
    
    // Global notification function (vanilla JS)
    window.showNotification = function(type, message) {
        if (typeof Swal !== 'undefined') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            
            Toast.fire({
                icon: type,
                title: message
            });
        } else {
            // Fallback to browser alert
            alert(message);
        }
    };
</script>