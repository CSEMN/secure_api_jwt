@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        @if($access_token)
                            <div>User Name : {{auth()->user()->name}}</div>
                            <div>Email : {{auth()->user()->email}}</div>
                            <div>Access Token : {{$access_token}}</div>
                            <div>Token Type : {{$token_type}}</div>
                            <div>Expires in : ({{$expires_in}}) sec</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
