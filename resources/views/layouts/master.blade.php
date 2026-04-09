@extends('layouts.base')

@section('title', $title ?? 'HappilyWeds - Wedding Planning & Inspiration')

@push('styles')
    <style>
        :root {
            --primary-pink: #f8a5c2;
            --light-pink: #fdeff6;
            --dark-pink: #e75480;
            --gold: #d4af37;
            --light-gold: #f7efd9;
            --text-dark: #333333;
            --text-light: #666666;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            background-color: #fff;
            line-height: 1.6;
        }
        
        .image-wrapper{
            position: relative;
            display: block;
        }
        
        .blur-image{
            filter: blur(15px);
            pointer-events: none;
            user-select: none;
        }
        
        .login-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,  -50%);
            z-index: 2;
            background: rgba(0, 0, 0, 0);
            padding: 10px 15px;
            border-radius: 6px;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            color: var(--text-dark);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70px;
            height: 3px;
            background-color: var(--primary-pink);
        }
        
        .btn-primary {
            background-color: var(--dark-pink);
            border-color: var(--dark-pink);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #d44673;
            border-color: #d44673;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 84, 128, 0.3);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 0.25rem rgba(248, 165, 194, 0.25);
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light-pink);
            color: var(--dark-pink);
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background-color: var(--dark-pink);
            color: white;
            transform: translateY(-3px);
        }
    </style>
    @stack('page-styles')
@endpush

@section('content')
    @yield('page-content')
@endsection