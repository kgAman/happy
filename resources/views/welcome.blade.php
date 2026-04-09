<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HappilyWeds — Find Your Life Partner</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    :root {
      --primary: #6A0DAD;    /* Deep purple / romantic tone */
      --secondary: #F5C542;  /* Gold accent */
      --accent: #2C003E;     /* Dark slate accent/background */
      --light: #F3EFFA;      /* Soft off-white background */
      --text: #2A2A2A;       /* Dark text */
      --base-bg: #f8e5e5;    /* Soft base background for cards / testimonials etc. */
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text);
      background-color: var(--light);
    }
    h1, h2, h3, h4, h5 {
      font-family: 'Playfair Display', serif;
      color: var(--primary);
      font-weight: 700;
    }
    .navbar {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem;
      color: var(--primary);
    }
    .nav-link {
      color: var(--text) !important;
      font-weight: 500;
      position: relative;
    }
    .nav-link:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--primary);
      transition: width 0.3s ease;
    }
    .nav-link:hover:after {
      width: 100%;
    }
    .hero-section {
      background: linear-gradient(rgba(106,13,173,0.85), rgba(44,0,62,0.85)),
                  url('https://images.unsplash.com/photo-1529255484355-cb73c33c04bb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')
                  no-repeat center center;
      background-size: cover;
      color: white;
      padding: 160px 0 110px;
    }
    .hero-section h1 {
      text-shadow: 1px 1px 8px rgba(0,0,0,0.6);
    }
    .hero-section .lead {
      color: #F7EFFF;
    }
    .btn-primary {
      background-color: var(--primary);
      border-color: var(--primary);
      padding: 12px 28px;
      border-radius: 30px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: var(--secondary);
      border-color: var(--secondary);
    }
    .btn-outline-light {
      color: white;
      border-color: white;
      padding: 12px 28px;
      border-radius: 30px;
      font-weight: 500;
    }
    .btn-outline-light:hover {
      background-color: rgba(255,255,255,0.2);
      border-color: white;
    }
    .section-title {
      position: relative;
      margin-bottom: 2.5rem;
    }
    .section-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 70px;
      height: 4px;
      background-color: var(--primary);
    }
    .feature-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      background-color: white;
      transition: transform 0.3s ease;
    }
    .feature-card:hover {
      transform: translateY(-10px);
    }
    .feature-icon {
      font-size: 3rem;
      color: var(--secondary);
      margin-bottom: 1.2rem;
    }
    .testimonial-card {
      background-color: var(--base-bg);
      border-left: 4px solid var(--secondary);
      padding: 30px;
      margin-bottom: 30px;
      border-radius: 8px;
      position: relative;
    }
    .testimonial-author {
      color: var(--primary);
      font-weight: 600;
      margin-top: 18px;
    }
    .success-badge {
      position: absolute;
      top: -12px;
      right: -12px;
      background: var(--secondary);
      color: white;
      border-radius: 50%;
      width: 34px;
      height: 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
    }
    .search-box {
      background: white;
      border-radius: 12px;
      padding: 35px;
      box-shadow: 0 8px 40px rgba(0,0,0,0.05);
    }
    .gallery img {
      border-radius: 8px;
      width: 100%;
      height: auto;
    }
    .footer {
      background-color: #2d2d2d;
      color: white;
      padding: 70px 0 40px;
    }
    .footer h5, .footer h4 {
      color: white;
    }
    .footer a {
      color: white;
      text-decoration: none;
    }
    .footer a:hover {
      color: var(--secondary);
    }
    .social-icons a {
      color: white;
      font-size: 1.3rem;
      margin-right: 18px;
      transition: color 0.3s ease;
    }
    .social-icons a:hover {
      color: var(--secondary);
    }
    hr {
      border-color: rgba(255,255,255,0.2);
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fas fa-heart me-2"></i>HappilyWeds
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
          <li class="nav-item"><a class="nav-link" href="#love-stories">Love Stories</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item ms-2"><a class="btn btn-outline-light" href="#">Login</a></li>
          <li class="nav-item ms-2"><a class="btn btn-primary" href="#">Register Free</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-4 fw-bold mb-4">Find Your Forever Love</h1>
          <p class="lead mb-4">HappilyWeds — where hearts meet, shared dreams begin, and forever stories are born.</p>
          <div class="d-flex flex-wrap gap-3">
            <a href="#" class="btn btn-primary btn-lg">Start Your Journey</a>
            <a href="#love-stories" class="btn btn-outline-light btn-lg">View Love Stories</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="search-box mt-5 mt-lg-0">
            <h3 class="mb-4" style="color: var(--primary)">Discover Your Match</h3>
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Looking for</label>
                  <select class="form-select">
                    <option>Bride</option>
                    <option>Groom</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Age</label>
                  <select class="form-select">
                    <option>18-25</option>
                    <option>26-30</option>
                    <option>31-35</option>
                    <option>36-40</option>
                    <option>40+</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Religion</label>
                  <select class="form-select">
                    <option>Hindu</option>
                    <option>Muslim</option>
                    <option>Christian</option>
                    <option>Sikh</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Community</label>
                  <select class="form-select">
                    <option>Any</option>
                    <option>Brahmin</option>
                    <option>Kshatriya</option>
                    <option>Vaishya</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Education</label>
                  <select class="form-select">
                    <option>Any</option>
                    <option>High School</option>
                    <option>Bachelor's Degree</option>
                    <option>Master's Degree</option>
                    <option>Doctorate</option>
                  </select>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary w-100">Find Matches</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section id="how-it-works" class="py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="section-title text-center">How HappilyWeds Works</h2>
          <p class="lead">Our simple, secure, and heart-centered process brings you closer to a partner who values the same things as you do.</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card p-4 h-100 text-center">
            <div class="feature-icon"><i class="fas fa-user-plus"></i></div>
            <h4>Create Your Dream Profile</h4>
            <p>Tell your story — share your personality, values, education, and aspirations. Let your true self shine.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 h-100 text-center">
            <div class="feature-icon"><i class="fas fa-search"></i></div>
            <h4>Search & Discover</h4>
            <p>Use our powerful filters to browse potential matches based on your preferences. See those who resonate with your values and lifestyle.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 h-100 text-center">
            <div class="feature-icon"><i class="fas fa-comments"></i></div>
            <h4>Connect & Build Trust</h4>
            <p>Chat, get to know each other, build compatibility — when both feel ready, take the next meaningful step together.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Love Stories / Testimonials Section -->
  <section id="love-stories" class="py-5" style="background-color: #ffffff;">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="section-title text-center">Love Stories ❤️</h2>
          <p class="lead">Real couples who met through HappilyWeds and found their forever. Their stories give hope and inspiration to those still searching.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial-card position-relative">
            <span class="success-badge"><i class="fas fa-heart"></i></span>
            <p>"We first connected on HappilyWeds after months of hope, prayers and patience. Our first video-call felt like we had known each other forever. Today, we are happily married and grateful for this beautiful platform."</p>
            <div class="testimonial-author">— Neha & Rohan, Married 2024</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial-card position-relative">
            <span class="success-badge"><i class="fas fa-heart"></i></span>
            <p>"As someone who valued culture and shared values, HappilyWeds helped me find someone who matched both my heart and beliefs. We are now engaged — eagerly preparing for the next chapter of our lives."</p>
            <div class="testimonial-author">— Priya & Amit, Engaged</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section (Romantic / Inspirational Images) -->
  <section id="gallery" class="py-5" style="background-color: var(--light);">
    <div class="container">
      <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
          <h2 class="section-title text-center">Moments & Memories</h2>
          <p class="lead">Visual glimpses of love, laughter and the journey of hearts coming together.</p>
        </div>
      </div>
      <div class="row g-4 gallery">
        <div class="col-md-4"><img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=800&q=80" alt="couple holding hands"></div>
        <div class="col-md-4"><img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=800&q=80" alt="romantic heart lights"></div>
        <div class="col-md-4"><img src="https://images.unsplash.com/photo-1534081333815-ae5019106622?auto=format&fit=crop&w=800&q=80" alt="sunset couple silhouette"></div>
      </div>
    </div>
  </section>

  <!-- Blog / Resources Section -->
  <section id="blog" class="py-5">
    <div class="container">
      <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
          <h2 class="section-title text-center">Love & Relationship Tips</h2>
          <p class="lead">Helpful articles to guide you on love, communication, and building a lasting bond.</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card p-4 h-100">
            <h4>How to Write a Meaningful Profile</h4>
            <p>Tips & tricks to showcase your true self and attract matches aligned with your personality.</p>
            <a href="#" class="text-decoration-none" style="color: var(--primary)">Read More →</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 h-100">
            <h4>First Date Ideas That Spark Connection</h4>
            <p>Creative and thoughtful first-date suggestions to make your meeting memorable.</p>
            <a href="#" class="text-decoration-none" style="color: var(--primary)">Read More →</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 h-100">
            <h4>Maintaining Trust & Respect</h4>
            <p>Guidance on building trust, communication and respect — the pillars of a lasting relationship.</p>
            <a href="#" class="text-decoration-none" style="color: var(--primary)">Read More →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="py-5 text-center" style="background-color: var(--accent); color: white;">
    <div class="container">
      <h2 class="mb-4">Ready to meet someone who truly understands you?</h2>
      <p class="lead mb-4">Join HappilyWeds today and start the journey to forever — your soulmate might be just a click away.</p>
      <a href="#" class="btn btn-primary btn-lg me-3">Create Free Profile</a>
      <a href="#" class="btn btn-outline-light btn-lg">Take a Tour</a>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contact" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h4><i class="fas fa-heart me-2"></i>HappilyWeds</h4>
          <p>Your trusted matchmaking service — helping hearts find their perfect companion since 2025.</p>
          <div class="social-icons mt-4">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#">Home</a></li>
            <li class="mb-2"><a href="#how-it-works">How It Works</a></li>
            <li class="mb-2"><a href="#love-stories">Love Stories</a></li>
            <li class="mb-2"><a href="#blog">Blog</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5>Contact Info</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Your City, State, Country</li>
            <li class="mb-2"><i class="fas fa-phone me-2"></i> +91 0000000000</li>
            <li class="mb-2"><i class="fas fa-envelope me-2"></i> support@happilyweds.com</li>
          </ul>
        </div>
        <div class="col-lg-2">
          <h5>Newsletter</h5>
          <p>Get love tips & updates.</p>
          <form>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Your email" />
              <button class="btn btn-primary" type="button">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-6 text-center text-md-start">
          <p>&copy; 2025 HappilyWeds. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <a href="#" class="me-3">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
