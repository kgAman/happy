@extends('layouts.admin')
@section('title', 'Add New Area - HappilyWeds')

@push('page-styles')
<style>
    .premium-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); }
</style>
@endpush

@section('content')
<div class="bg-glow-orb orb-1"></div>
<div class="bg-glow-orb orb-2"></div>

<div class="container py-5 page-spacing font-sans" style="max-width: 800px;">
    <div class="premium-card p-5 animate-card">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.areas.index') }}" class="btn btn-light rounded-circle" style="width: 40px; height: 40px;"><i class="bi bi-arrow-left"></i></a>
            <h2 class="font-serif fw-bold text-gradient m-0">Add New Area</h2>
        </div>

        <form method="POST" action="{{ route('admin.areas.store') }}">
            @csrf
            <div class="mb-3">
                <label class="premium-label">Area Name</label>
                <input type="text" name="area" class="form-control premium-input @error('area') is-invalid @enderror" value="{{ old('area') }}" required>
                @error('area') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="premium-label">District</label>
                <input type="text" name="district" class="form-control premium-input @error('district') is-invalid @enderror" value="{{ old('district') }}" required>
                @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="premium-label">State</label>
                <input type="text" name="state" class="form-control premium-input @error('state') is-invalid @enderror" value="{{ old('state') }}" required>
                @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="premium-label">Country</label>
                <input type="text" name="country" class="form-control premium-input @error('country') is-invalid @enderror" value="{{ old('country') }}" required>
                @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="premium-label">Area Type</label>
                <input type="text" name="area_type" class="form-control premium-input @error('area_type') is-invalid @enderror" value="{{ old('area_type') }}" placeholder="urban / rural / city" required>
                @error('area_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn-glow px-5">Create Area</button>
                <a href="{{ route('admin.areas.index') }}" class="btn btn-light px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection