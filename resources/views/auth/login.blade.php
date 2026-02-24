@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="text-center mb-5">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 24px;">
                <i data-lucide="shield-check" style="width: 40px; height: 40px;"></i>
            </div>
            <h2 class="fw-bold text-dark">Welcome Back</h2>
            <p class="text-secondary">Please enter your details to sign in to InventoryPro</p>
        </div>

        <div class="card border-0 shadow-lg animate-fade-in" style="border-radius: 24px;">
            <div class="card-body p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label text-secondary fw-medium">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary" style="border-radius: 12px 0 0 12px;">
                                <i data-lucide="mail" style="width: 18px;"></i>
                            </span>
                            <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="admin@example.com" style="border-radius: 0 12px 12px 0; padding: 12px;">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label text-secondary fw-medium">Password</label>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-secondary" style="border-radius: 12px 0 0 12px;">
                                <i data-lucide="lock" style="width: 18px;"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••" style="border-radius: 0 12px 12px 0; padding: 12px;">
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary small" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-lg mb-0" style="border-radius: 12px;">
                        <i data-lucide="log-in" class="me-2"></i> Sign In
                    </button>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-secondary small">© {{ date('Y') }} InventoryPro System. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
    
    // Hide navbar links on login page if desired
    document.addEventListener('DOMContentLoaded', function() {
        const navMain = document.getElementById('navMain');
        if (navMain) {
            navMain.style.display = 'none';
        }
    });
</script>
@endsection
