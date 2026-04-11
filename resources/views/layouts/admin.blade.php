<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - HappilyWeds')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Select2 CSS — MUST be before your page styles so overrides work --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-pink: #e75480;
            --light-pink: #fdeff6;
            --sidebar-width: 280px; 
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0 0 40px 0; 
        }

        .admin-top-nav {
            background: #ffffff;
            padding: 15px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-header-btn {
            transition: all 0.2s ease;
        }
        .admin-header-btn:hover {
            background-color: var(--light-pink);
            color: var(--primary-pink);
        }

        .admin-page-content {
            padding: 30px 40px;
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .main-content { margin-left: 0; }
            .admin-page-content { padding: 20px; }
        }
    </style>

    {{-- Page-specific styles go HERE, outside any <style> block --}}
    @stack('page-styles')
</head>
<body>

    <div class="admin-wrapper">
        
        @include('includes.slidebar')

        <div class="main-content">
            
            <div class="admin-top-nav shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center px-3 rounded-pill admin-header-btn">
                        <i class="bi bi-globe me-2"></i> View Site
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center border-0 rounded-pill px-3 py-2"
                            type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            style="background: #f8f9fc;">
                            <i class="bi bi-person-circle fs-5 text-secondary me-2"></i>
                            <span class="fw-semibold text-dark me-1">{{ auth()->user()->name ?? 'Admin User' }}</span>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 rounded-4" aria-labelledby="adminDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 px-3 fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="admin-page-content">
                @yield('content')
            </div>
            
        </div>

    </div>

    {{-- jQuery FIRST — everything else depends on it --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Dropzone JS (loaded globally so all pages can use it) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>