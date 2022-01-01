@extends('layouts.app')

@section('content')

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="
          background: url('../assets/images/background/login-register.jpg')
            no-repeat center center;
          background-size: cover;
        ">
        <div class="auth-box p-4 bg-white rounded-lg">
            <div id="loginform">
                <div class="logo">
                    <h3 class="box-title mb-3">Register</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3" id="loginform" method="POST" action="{{ route('register') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="first_name" class="input-label">{{ __('First name') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="input-label">{{ __('Last name') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username" class="input-label">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="input-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="referral_id" class="input-label">{{ __('Referral ID') }}</label>
                                <input id="referral_id" type="text" class="form-control @error('email') is-invalid @enderror" name="referral_id" value="{{ old('referral_id') }}">

                                @error('referral_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="input-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="input-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group text-center mt-4 mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                        Register
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-4">
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <p>
                                        Have an account?
                                        <a href="{{ route('login') }}" class="text-info font-weight-medium ms-1">Login</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
{{--    <div class="form-group">--}}
{{--        <label for="first_name" class="input-label">{{ __('First name') }}</label>--}}
{{--        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>--}}

{{--        @error('first_name')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--        @enderror--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label for="last_name" class="input-label">{{ __('Last name') }}</label>--}}
{{--        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>--}}

{{--        @error('last_name')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <label for="username" class="input-label">{{ __('Username') }}</label>--}}
{{--        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">--}}

{{--        @error('username')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div class="form-group">--}}
{{--        <label for="email" class="">{{ __('E-Mail Address') }}</label>--}}
{{--        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--        @error('email')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--        @enderror--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label for="password" class="input-label">{{ __('Password') }}</label>--}}
{{--        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}
{{--        @error('password')--}}
{{--        <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--        @enderror--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label for="password-confirm" class="input-label">{{ __('Confirm Password') }}</label>--}}
{{--        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--    </div>--}}
@endsection
