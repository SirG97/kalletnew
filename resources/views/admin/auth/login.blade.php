@extends('admin.layouts.app')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="
          background: url('../assets/images/background/login-register.jpg')
            no-repeat center center;
          background-size: cover;
        ">
        <div class="auth-box p-4 bg-white rounded-lg">
            <div id="loginform">
                <div class="logo">
                    <h3 class="box-title mb-3">Admin Sign In</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" id="loginform" method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="example@mail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="*******" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex">
                                    <div class="checkbox checkbox-info pt-0">
                                        <input id="checkbox-signup" type="checkbox" class="material-inputs chk-col-indigo">
                                        <label for="checkbox-signup"> Remember me </label>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{ route('admin.password.request') }}" id="to-recover" class="link font-weight-medium"><i class="fa fa-lock me-1"></i> Forgot password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mt-4 mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                        Log In
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-4">
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <p>
                                        Don't have an account?
                                        <a href="{{ route('admin.register') }}" class="text-info font-weight-medium ms-1">Sign Up</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<div class="container">

{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('admin.password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
@endsection
