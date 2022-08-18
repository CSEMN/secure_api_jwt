@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{($_COOKIE['lang']=='ar')?'تسجيل الدخول':'Login'}}</div>

                    <div class="card-body">
                        <form method="POST" action="/api/login" id="emailPassLogin" dir="ltr">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end"> {{($_COOKIE['lang']=='ar')?'البريد الالكتروني':'Email Address'}}</label>

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
                                       class="col-md-4 col-form-label text-md-end"> {{($_COOKIE['lang']=='ar')?'كلمة السر':'password'}}</label>

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
                                            {{($_COOKIE['lang']=='ar')?'تذكرني':'Remember me'}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{($_COOKIE['lang']=='ar')?'دخول':'Login'}}
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



                        </form>
                        <div
                            style="width: 100%; height: 12px; border-bottom: 1px solid rgba(0, 0, 0, 0.175); text-align: center">
                              <span
                                  style="font-size: 15px;background-color: #fff ;color: rgba(0, 0, 0, 0.5) ;border-radius: 200px ; padding: 0 5px;">
                                 {{($_COOKIE['lang']=='ar')?'أو':'OR'}}
                              </span>
                        </div>
                        <div class="row mb-1 mt-3" style="text-align: center;">
                            <div class="col-md-12">


                                <form method="get" id="handelGoogleAjax" name="handelGoogleAjax"
                                      action="/api/google/redirect" style="display: inline">
                                    @csrf
                                    <input type="image" src="{{asset('/assets/google_logo.png')}}" alt="Submit Form"
                                           height="40px" style="margin:0 10px;"/>
                                </form>
                                <form method="get" id="handelGithubAjax" name="handelGithubAjax"
                                      action="/api/github/redirect" style="display: inline;">
                                    @csrf
                                    <input type="image" src="{{asset('/assets/github_logo.png')}}" alt="Submit Form"
                                           height=40px"/>
                                </form>
                            </div>

                        </div>

                        <div class="row mb-1" style="text-align: center;">
                            <div class="col-md-12">
                                {{($_COOKIE['lang']=='ar')?'تحتاج حساب ؟':'Need an Account?'}}
                                <a href="/register" class="btn btn-link" style="text-decoration: none;">
                                    {{($_COOKIE['lang']=='ar')?'تسجيل':'signup'}}
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            // handle submit event of Google form
            // $(document).on("submit", "#emailPassLogin", function () {
            //     let loginForm = $("#emailPassLogin");
            //     $.ajax({
            //         type: "POST",
            //         url: loginForm.attr('action'),
            //         data: loginForm.serialize(),
            //         dataType: 'json',
            //
            //         success: function(data) {
            //             alert("success");
            //             document.cookie='token='+data['access_token'];
            //             window.location.href='/home'
            //         },
            //         error:function(XMLHttpRequest, textStatus, errorThrown) {
            //             alert(errorThrown);
            //         },
            //
            //
            //     });
            // });

        });
    </script>
@endsection
