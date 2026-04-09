@extends('layouts.app')
@section('title', 'Create Permission')
@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light mb-0">
            <i class="bi bi-shield-lock me-2"></i> Create Permission
        </h3>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-light shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold"><i class="bi bi-collection me-1"></i> Permission Group</label>
                    @php
                        $types = ['Sales Team','Report','Users','Setting'];
                    
                        sort($types); // 🔥 Sort alphabetically
                    @endphp
                    
                    <select name="type" class="form-control form-control-lg shadow-sm">
                        <option value="">Select Group</option>
                    
                        @foreach($types as $opt)
                            <option value="{{ $opt }}" {{ old('type') == $opt ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>


                </div>

                {{-- Permission Name --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-fonts me-1"></i> Permission Name
                    </label>
                    <input type="text" name="name"
                           class="form-control form-control-lg shadow-sm"
                           placeholder="Enter permission name">
                </div>

                {{-- Buttons --}}
                <div class="mt-3">
                    <button class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="bi bi-save me-1"></i> Save
                    </button>

                    <a href="{{ route('admin.permissions.index') }}"
                       class="btn btn-light border px-4 py-2 shadow-sm">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
