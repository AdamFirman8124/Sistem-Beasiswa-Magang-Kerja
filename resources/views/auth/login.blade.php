@extends('layouts.app_auth_nofooter')

@section('content')
    {{-- PC --}}
    <div class="container d-none d-lg-block p-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="rounded-start-5 bg-white" style="width: 28%">
                    <div class="d-flex justify-content-center mt-5">
                        <img class="img" style="width: 30%" src="{{ asset('assets/logo-uns.webp') }}" alt="image">
                    </div>
                    <div class="text">
                        <p class="h2 text-center fw-bold mt-4 mb-4">
                            Sign In to SIUNS
                        </p>
                    </div>
                    <div class="input mt-5">
                        <div class="mb-4 px-5">
                            <label for="email" class="form-label fw-bold">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="email@example.com" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mb-3 px-5 position-relative">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="password" required
                                    autocomplete="current-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Button --}}
                    <div class="px-5 d-flex justify-content-center">
                        <button type="submit" class="btn btn-login w-100">
                            Sign In
                        </button>
                    </div>
                </div>
                <div class="rounded-end-5" style="width: 28%">
                    <img class="img" style="width: 100%" src="{{ asset('assets/foto-login.webp') }}" alt="image">
                </div>
            </div>
        </form>
    </div>

    {{-- HP --}}
    <div class="container d-block d-lg-none">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="d-flex justify-content-center mt-3 pt-5">
                <div class="rounded-5 bg-white" style="width: 90%">
                    <div class="d-flex justify-content-center mt-5">
                        <img class="img" style="width: 30%" src="{{ asset('assets/logo-uns.webp') }}" alt="image">
                    </div>
                    <div class="text">
                        <p class="h2 text-center fw-bold mt-4 mb-4">
                            Sign In to SIUNS
                        </p>
                    </div>
                    <div class="input mt-5">
                        <div class="mb-4 px-5">
                            <label for="email" class="form-label fw-bold">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email-mobile" name="email" placeholder="email@example.com" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="mb-3 px-5 position-relative">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password-mobile" name="password" placeholder="password" required
                                    autocomplete="current-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword-mobile" style="cursor: pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Button --}}
                    <div class="px-5 d-flex justify-content-center mb-5">
                        <button type="submit" class="btn btn-login w-100">
                            Sign In
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // pc
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye / eye slash icon
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        // hp
        const togglePasswordMobile = document.querySelector('#togglePassword-mobile');
        const passwordMobile = document.querySelector('#password-mobile');
        const iconMobile = togglePasswordMobile.querySelector('i');

        togglePasswordMobile.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = passwordMobile.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordMobile.setAttribute('type', type);
            // toggle the eye / eye slash icon
            iconMobile.classList.toggle('bi-eye');
            iconMobile.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
