<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <style>
        :root {
            --primary: #6A0DAD; /* Deep red from Sitara website */
            --secondary: #F5C542; /* Gold accent */
            --accent: #2C003E; /* Dark slate */
            --light: #F3EFFA; /* Off-white background */
            --text: #2A2A2A; /* Dark text */
            --sidebar-width: 260px;
            --header-height: 60px;
            --base: #6A0DAD;
            --base-light: #a81717;
            --base-dark: #5e0000;
            --base-bg: #f8e5e5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7fc;
            color: var(--text);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
    
        /* Background */
        .bg-base { background-color: var(--primary) !important; }
        .bg-base-light { background-color: var(--base-light) !important; }
        .bg-base-dark { background-color: var(--base-dark) !important; }
        .bg-base-soft { background-color: var(--base-bg) !important; }
    
        /* Text */
        .text-base { color: var(--primary) !important; }
        .text-base-dark { color: var(--base-dark) !important; }
    
        /* Button */
        .btn-base {
            background-color: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
        }
    
        .btn-base:hover {
            background-color: var(--base-dark) !important;
            border-color: var(--base-dark) !important;
            color: #fff !important;
        }
    
        /* Outline Button */
        .btn-outline-base {
            border: 1px solid var(--primary) !important;
            color: var(--primary) !important;
        }
    
        .btn-outline-base:hover {
            background-color: var(--primary) !important;
            color: #fff !important;
        }
    
        /* Borders */
        .border-base { border-color: var(--primary) !important; }


        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #fff;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 0px 0;
            transition: all 0.3s;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo-container {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: var(--primary);
            height: var(--header-height);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo i {
            color: var(--secondary);
        }

        .nav-links {
            list-style: none;
            padding: 0px 0;
        }

        .nav-links li {
            padding: 12px 20px;
            transition: all 0.3s;
        }

        .nav-links li:hover {
            background: rgb(87, 0, 139, 0.1);
            border-left: 4px solid var(--secondary);
        }

        .nav-links li.active {
            background: rgb(87, 0, 139, 0.15);
            border-left: 4px solid var(--secondary);
        }

        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 16px;
        }

        .nav-links i {
            font-size: 18px;
            width: 25px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            flex: 1;
            transition: all 0.3s;
            min-height: calc(100vh - var(--header-height));
        }
        
        .header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 25px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 999;
            transition: all 0.3s;
        }

        .header-separator{
            background: var(--primary);
            margin-bottom: 30px;
            position: fixed;
            z-index:-1;
            height: 200px;
            width: 100%;
            top: 0;
        }

        .header h1 {
            color: var(--primary);
            font-weight: 600;
            margin: 0;
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 15px 10px 40px;
            border-radius: 50px;
            border: 1px solid #e0e0e0;
            width: 300px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgb(87, 0, 139, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .notification-icon {
            position: relative;
            font-size: 1.5rem;
            color: var(--accent);
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        


        /* Dashboard Stats */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: var(--primary);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .trend-up {
            color: #2ecc71;
        }

        .trend-down {
            color: #e74c3c;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-container, .summary-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chart-placeholder {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 8px;
            color: #7f8c8d;
            flex-direction: column;
        }

        .chart-placeholder i {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--primary);
            opacity: 0.5;
        }

        /* Recent Activities & Top Products */
        .activities-products {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .activities-list, .products-list {
            list-style: none;
            margin-top: 10px;
        }

        .activity-item, .product-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .activity-item:last-child, .product-item:last-child {
            border-bottom: none;
        }

        .activity-icon, .product-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .bg-info { background: #17a2b8; }
        .bg-success { background: #2ecc71; }
        .bg-warning { background: #f39c12; }
        .bg-secondary { background: #6c757d; }

        .activity-content h4, .product-content h4 {
            font-size: 15px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .activity-content p, .product-content p {
            font-size: 13px;
            color: #7f8c8d;
        }

        .product-stats {
            margin-left: auto;
            text-align: right;
        }

        .product-sales {
            font-weight: 600;
            color: var(--primary);
        }

        .product-growth {
            font-size: 12px;
            color: #2ecc71;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .action-btn {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 25px 20px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .action-btn i {
            font-size: 28px;
            color: var(--primary);
        }

        .action-btn span {
            font-weight: 600;
            font-size: 16px;
            color: var(--accent);
        }
        
        .dropzone {
            border: 2px dashed #0dcaf0 !important;
            border-radius: 10px;
            background: #f8ffff;
            cursor: pointer;
        }
    
        .dz-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 992px) {
            .user-table {
                display: block;
                overflow-x: auto;
            }
            
            .search-box input {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .logo span, .nav-links span {
                display: none;
            }
            
            .nav-links li {
                text-align: center;
                padding: 15px 5px;
            }
            
            .nav-links a {
                justify-content: center;
            }
            
            .header {
                left: 70px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .search-box input {
                width: 150px;
            }
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                height: auto;
                padding: 15px;
                gap: 15px;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .search-box input {
                width: 120px;
            }
            
            .main-content {
                padding: 15px;
            }
            
            body {
                padding-top: 120px;
            }
        }
        /* Print Styles */
        @media print {
            .sidebar, .header, .header-separator {
                display: none !important;
            }
            
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            
            body {
                padding-top: 0 !important;
                background: white !important;
            }
            
            .stat-card, .table-container {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                page-break-inside: avoid;
            }
            
            .btn-edit, .btn-delete {
                display: none !important;
            }
            
            .user-table thead {
                background: #f8f9fa !important;
                color: black !important;
            }
            
            .user-table th, .user-table td {
                color: black !important;
                border: 1px solid #ddd !important;
            }
            
            .role-badge {
                background: #f8f9fa !important;
                color: black !important;
                border: 1px solid #ddd !important;
            }
        }
        /* Match Bootstrap 5 form-control-sm */
        .select2-container--default .select2-selection--single {
            height: calc(1.5em + .5rem + 9px);
            padding: .25rem .5rem;
            font-size: .875rem;
            border-radius: .2rem;
            border: 1px solid #ced4da;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + .5rem);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="header-separator"></div>
    @include('includes.slidebar')
    @include('includes.header')
    <div class="main-content" style="margin-top:80px;">
        @yield('content')
    </div>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
        
        // Interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event to navigation items
            const navItems = document.querySelectorAll('.nav-links li');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Add hover effect to buttons
            const actionButtons = document.querySelectorAll('.btn-edit, .btn-delete');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add notification click event
            const notificationIcon = document.querySelector('.notification-icon');
            notificationIcon.addEventListener('click', function() {
                alert('You have 5 new notifications');
            });

            // Search functionality
            const searchInput = document.querySelector('.search-box input');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.user-table tbody tr');
                
                rows.forEach(row => {
                    const name = row.querySelector('.user-name div:last-child').textContent.toLowerCase();
                    const email = row.cells[1].textContent.toLowerCase();
                    const role = row.cells[2].textContent.toLowerCase();
                    
                    if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Handle responsive sidebar
            function handleSidebar() {
                if (window.innerWidth <= 768) {
                    document.querySelector('.sidebar').classList.add('collapsed');
                } else {
                    document.querySelector('.sidebar').classList.remove('collapsed');
                }
            }

            window.addEventListener('resize', handleSidebar);
            handleSidebar();
        });
    </script>
</body>
</html>
