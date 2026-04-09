@extends('layouts.app')
@section('title', 'Create New Profile')
@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light">✨ Create New Profile</h3>
        <a href="{{ route('admin.profiles.index') }}" class="btn btn-outline-light">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            {{-- Error Message Block --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm">
                    <h5 class="fw-bold">⚠️ Please fix the following errors:</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @include('profiles.form')

                <div class="text-end">
                    <button class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm mt-3">
                        <i class="bi bi-check2-circle me-1"></i> Save Profile
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Optional CSS Enhancements --}}
<style>
    .form-label {
        font-weight: 600;
    }
    input, select, textarea {
        border-radius: 0.5rem !important;
    }
    .card {
        animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
