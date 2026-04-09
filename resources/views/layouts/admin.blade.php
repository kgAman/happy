<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - HappilyWeds')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-pink: #e75480;
            --light-pink: #fdeff6;
            --sidebar-width: 280px; /* Matched to your new premium sidebar width */
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* Layout Structure */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* --- MAIN CONTENT STYLING --- */
        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Custom dropdown styling */
        .admin-header-btn {
            transition: all 0.2s ease;
        }
        .admin-header-btn:hover {
            background-color: var(--light-pink);
            color: var(--primary-pink);
        }

        @stack('page-styles')
    </style>
</head>
<body>

    <div class="admin-wrapper">
        
        @include('includes.slidebar')

        <div class="main-content">
            
            <div class="bg-white py-3 px-4 border-bottom shadow-sm d-flex justify-content-between align-items-center">
                
                <div></div>

                <div class="d-flex align-items-center gap-3">
                    
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center px-3 rounded-pill admin-header-btn">
                        <i class="bi bi-globe me-2"></i> View Site
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center border-0 rounded-pill px-3" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5 text-secondary me-2"></i>
                            <span class="fw-semibold text-dark me-1">{{ auth()->user()->name ?? 'Admin User' }}</span>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3" aria-labelledby="adminDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            @yield('content')
            
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>