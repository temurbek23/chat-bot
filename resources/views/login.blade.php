@extends('layouts.authentication.master')
@section('title', 'Login-one')

@section('css')
@endsection

@section('style')
    <style>
        .alert-custom {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
            max-width: 300px;
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 4px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/2.jpg')}}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-center" href="{{ route('login') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt="looginpage" width="150"></a></div>
                        <div class="login-main">
                            <form class="theme-form" action="{{route('sing-in')}}" method="post">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your phone & password to login</p>

                                {{-- Phone input --}}
                                <div class="form-group">
                                    <label class="col-form-label">Phone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required="" value="{{ old('phone') }}" placeholder="+998912345678">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Password input --}}
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="*********">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Submit button --}}
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Display session error as bottom-right alert --}}
        @if(session('error'))
            <div class="alert alert-custom">
                {{ session('message') }}
            </div>
        @endif
    </div>
@endsection

@section('script')
@endsection
