@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/api/login">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="row mb-0 mt-2">
                                    <div class="col-md-6 offset-md-4 " style="display: flex;justify-content: right;">
                                        <a class="btn btn-link align-self-end" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>

                                    </div>
                                </div>
                            @endif

                            <div style="width: 100%; height: 12px; border-bottom: 1px solid rgba(0, 0, 0, 0.175); text-align: center">
                              <span style="font-size: 15px;background-color: #fff ;color: rgba(0, 0, 0, 0.5) ;border-radius: 200px ; padding: 0 5px;">
                                OR
                              </span>
                            </div>
                            <div class="row mb-1 mt-3" style="text-align: center;">
                                <div class="col-md-12">
                                        <a href="/api/google/redirect" style="padding: 10px;text-decoration: none;">
                                            <img src="{{asset('/assets/google_logo.png')}}" alt="Google Logo" height="35 px"/>
                                        </a>
                                        <a href="/api/github/redirect" style="padding: 10px;">
                                            <img src="{{asset('/assets/github_logo.png')}}" alt="Github Logo" height="50 px"/>
                                        </a>
                                </div>

                            </div>

                            <div class="row mb-1" style="text-align: center;">
                                <div class="col-md-12">
                                    Need an Account?
                                    <a href="/register" class="btn btn-link" style="text-decoration: none;">
                                        Sign up
                                    </a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
