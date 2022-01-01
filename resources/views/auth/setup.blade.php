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
                    <h3 class="box-title mb-3">Complete registration</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" id="loginform" method="POST" action="{{ route('setup') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="date" class="input-label">{{ __('Date of birth') }}</label>
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="name" autofocus>

                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address" class="input-label">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="name" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="input-label">{{ __('Phone') }}</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="email">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country" class="input-label">{{ __('Country') }}</label>
                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Nigeria">Nigeria</option>
                                    {{--                                <option value="Singapore">Singapore</option>--}}
                                    {{--                                <option value="Indonesia">Indonesia</option>--}}
                                    {{--                                <option value="Vietnam">Vietnam</option>--}}
                                    {{--                                <option value="Thailand">Thailand</option>--}}
                                </select>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="currency" class="input-label">{{ __('Currency') }}</label>

                                <div class="">
                                    <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency" required>
                                        <option value="RM">Malaysian RM</option>
                                        <option value="NGN">Nigerian NGN</option>
                                        {{--                                <option value="SGD">Singaporean SGD</option>--}}
                                        {{--                                <option value="IDR">Indonesian IDR</option>--}}
                                        {{--                                <option value="VND">Vietnamese VND</option>--}}
                                        {{--                                <option value="THB">Thai THB </option>--}}
                                    </select>
                                    @error('currency')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pin" class="input-label">{{ __('Pin') }}</label>


                                <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" required autocomplete="">
                                @error('pin')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="confirm-pin" class="input-label">{{ __('Confirm pin') }}</label>
                                <input id="confirm-pin" type="text" class="form-control @error('pin_confirmation') is-invalid @enderror" name="pin_confirmation" required autocomplete="new-pin">
                                @error('pin_confirmation')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group text-center mt-4 mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
