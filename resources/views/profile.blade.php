@extends('layouts.user')
@section('content')
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            @include('includes.feedback')
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Your Profile')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('profile.save')}}" method="post">
                                @csrf
                                <div class="form-group row">
{{--                                    <label class="col-form-label col-lg-3">{{__('Full Name')}}</label>--}}
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-6 form-floating p-form mb-3">
                                                <input type="text" name="first_name" class="form-control" placeholder="{{__('First Name')}}" value="{{$user->first_name}}" readonly>
                                                <label>First name</label>
                                            </div>
{{--                                            <div class="col-6 form-floating mb-3">--}}
{{--                                                <input type="text" name="first_name" class="form-control" placeholder="{{__('First Name')}}" value="{{$user->first_name}}" readonly>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6">--}}
{{--                                                <input type="text" name="last_name" class="form-control" placeholder="{{__('Last Name')}}" value="{{$user->last_name}}" readonly>--}}
{{--                                            </div>--}}
                                            <div class="col-6 form-floating p-form mb-3">
                                                <input type="text" name="first_name" class="form-control" placeholder="{{__('First Name')}}" value="{{$user->first_name}}" readonly>
                                                <label>Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-floating p-form mb-3">
                                        <input type="text" name="username" class="form-control" placeholder="{{__('Your Username')}}" value="{{$user->username}}" readonly>
                                        <label>Username</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-floating p-form mb-3">
                                        <input type="text" name="phone" class="form-control" placeholder="{{__('Phone Number')}}" maxlength="14" value="{{$user->phone}}">
                                        <label>{{__('Phone Number')}}</label>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="form-floating p-form mb-3">
                                        <input type="date" name="dob" class="form-control" placeholder="{{__('Date of Birth')}}"  value="{{$user->dob}}">
                                        <label>{{__('Date of Birth')}}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-floating p-form mb-3">
                                        <input type="text" name="email" class="form-control" placeholder="{{__('Email Address')}}" value="{{$user->email}}">
                                        <label>{{__('Email Address')}}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-floating p-form mb-3">
                                        <input type="text" name="address" class="form-control" placeholder="{{__('Address')}}" value="{{$user->address}}">
                                        <label>{{__('Address')}}</label>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-lg">{{__('Save Changes')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="card-title mb-3">{{__('Account Photo')}}</h3>
                            <a href="#" class="avatar text-center mb-3 pb-3">
                                <img src="{{ asset('/storage') }}/{{ $user->photo }}" style="width: 100px; height: 100px; border-radius: 50%" />
                            </a>
                            <form action="{{ route('profile.image') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group mt-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" name="photo" accept="image/*" required>
                                        <label class="custom-file-label" for="customFileLang">{{__('Choose Media')}}</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-neutral btn-lg btn-block">{{__('Change Photo')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
{{--                    <div class="card">--}}
{{--                        <div class="card-body text-center">--}}
{{--                            <h3 class="card-title mb-3">{{__('Delete Account')}}</h3>--}}
{{--                            <p class="card-text text-sm text-dark">{{__('Closing this account means you will no longer be able to access this account on')}}</p>--}}
{{--                            <div class="text-right">--}}
{{--                                <a data-toggle="modal" data-target="#modal-formp" href="" class="btn btn-danger btn-block"><i class="fad fa-trash"></i> {{__('Delete Account')}}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="modal-formp" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="mb-0">{{__('Delete Account')}}</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <textarea type="text" name="reason" class="form-control" rows="5" placeholder="{{__('Sorry to see you leave, Please tell us why you are leaving')}}" required></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-neutral btn-block">{{__('Delete account')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
