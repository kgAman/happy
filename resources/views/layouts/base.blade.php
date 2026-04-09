<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HappilyWeds - Wedding Planning & Inspiration')</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/header.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/css/footer.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Include Header -->
    @include('includes.web_header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Include Footer -->
    @include('includes.web_footer')
    
    <!-- Include Scripts -->
    @include('includes.scripts')
    
    @stack('scripts')
</body>
</html>