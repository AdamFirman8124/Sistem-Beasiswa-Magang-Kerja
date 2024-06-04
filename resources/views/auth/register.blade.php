@extends('layouts.app_auth_nofooter')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role" required>
                                    <option value="guest">Guest</option>    
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="secret-code-container" style="display: none;">
                            <label for="secret-code" class="col-md-4 col-form-label text-md-end">{{ __('Secret Code') }}</label>

                            <div class="col-md-6">
                                <input id="secret-code" type="text" class="form-control" name="secret_code" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        var secretCodeContainer = document.getElementById('secret-code-container');
        var secretCodeInput = document.getElementById('secret-code');
        if (this.value === 'admin') {
            secretCodeContainer.style.display = '';
            secretCodeInput.setAttribute('required', 'required');
        } else {
            secretCodeContainer.style.display = 'none';
            secretCodeInput.removeAttribute('required');
        }
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        var role = document.getElementById('role').value;
        var email = document.getElementById('email').value;
        console.log("Role: " + role + ", Email: " + email);
        if (role === 'admin' && !email.includes('@student')) {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Email',
                text: 'Email untuk admin harus mengandung @student.',
                confirmButtonText: 'Coba Lagi'
            });
            event.preventDefault();
        }
    });
</script>
@endsection
