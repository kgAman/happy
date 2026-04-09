@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center">
                    <strong>Admin OTP Verification</strong>
                </div>

                <div class="card-body">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('otp.verify') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="otp" class="form-label">
                                Enter 6 Digit OTP
                            </label>

                            <input id="otp"
                                   type="text"
                                   maxlength="6"
                                   class="form-control @error('otp') is-invalid @enderror @if(session('error')) is-invalid @endif"
                                   name="otp"
                                   value="{{ old('otp') }}"
                                   required
                                   autofocus>

                            @error('otp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if(session('error'))
                                <div class="invalid-feedback d-block">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Verify OTP
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection