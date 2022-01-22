@extends('layouts.user')
@section('content')
    <div class="container">
        @include('includes.feedback')
        <div class="row no-gutters">
            <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-top-3 space-lg-0">
                <!-- Form -->
                <form role="form" action="{{route('upload-kyc')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-5 mb-md-7">
                        <h1 class="h2">{{ __('KYC Verification') }}</h1>
                        <p>{{ __('Ensure document provided contains the same information as of registration') }}</p>
                    </div>
                    <!-- End Title -->
                    <div class="form-group mb-3">
                        <select name="id_type" class="form-control select" @if($user->kyc_link!=null && $user->kyc_status==0 || $user->kyc_link!=null && $user->kyc_status==1) disabled @endif name="type" required>
                            <option value="">{{__('Identification type')}}</option>
                            <option value="Passport" @if($user->kyc_type=='Passport') selected @endif>{{__('Passport')}}</option>
                            <option value="National ID" @if($user->kyc_type=='National ID') selected @endif>{{__('National ID')}}</option>
                            <option value="Driver license" @if($user->kyc_type=='Driver license') selected @endif>{{__('Driver license')}}</option>
                            <option value="Voters card" @if($user->kyc_type=='Voters card') selected @endif>{{__('Voters card')}}</option>
                        </select>
                    </div>
                    @if($user->kyc_link==null)
                        <div class="text-center">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*">
                                    <label class="custom-file-label" for="customFileLang">{{__('Select document')}}</label>
                                </div>
                            </div>
                            @if ($errors->has('image'))
                                <span class="error form-error-msg ">
                        <strong>{{ $errors->first('image') }}</strong>
                        </span>
                            @endif
                        </div>
                    @endif
                    <div class="text-center">
                        @if($user->kyc_link==null && $user->kyc_status==0 || $user->kyc_link==null && $user->kyc_status==2)
                            <button type="submit" class="btn btn-primary btn-block transition-3d-hover">{{__('Upload')}}</button>
                        @endif

                        @if($user->kyc_link!=null && $user->kyc_status==0)
                            <p>Status:
                                <span class="badge badge-primary mb-3 bg-primary">{{__('Under review')}}</span>
                            </p>


                        @elseif($user->kyc_link!=null && $user->kyc_status==1)
                            <p>
                                Status:
                                <span class="badge badge-success bg-success mb-3">{{__('Approved')}}</span>
                            </p>


                        @elseif($user->kyc_link==null && $user->kyc_status==2)
                            <p>
                                Status:
                                <span class="badge badge-primary bg-danger mb-3">Declined: {{$user->kyc_reason}}</span>
                            </p>
                        @endif
                    </div>
                </form>
                <!-- End Form -->

                <!-- Form -->
                <form role="form" class="mt-3" action="{{ route('upload-kyc-address') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-5 mb-md-7">
                        <h1 class="h2">{{ __('Proof of address') }}</h1>
                        <p>{{ __('Upload a proof that confirms your address') }}</p>
                    </div>
                    <!-- End Title -->
                    @if($user->kyc_address_link == null)
                        <div class="text-center">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="kyc_address_link" accept="image/*" required>
                                    <label class="custom-file-label" for="customFileLang">{{__('Select document')}}</label>
                                </div>
                            </div>
                            @if ($errors->has('kyc_address_link'))
                                <span class="error form-error-msg ">
                        <strong>{{ $errors->first('kyc_address_link') }}</strong>
                        </span>
                            @endif
                        </div>
                    @endif
                    <div class="text-center">
                        @if($user->kyc_address_link == null && $user->kyc_address_status == 0 || $user->kyc_address_link == null && $user->kyc_aaddress_status == 2)
                            <button type="submit" class="btn btn-primary btn-block transition-3d-hover">{{__('Upload')}}</button>
                        @endif

                        @if($user->kyc_address_link != null && $user->kyc_address_status == 0)
                            <p>Status:
                                <span class="badge badge-primary mb-3 bg-primary">{{__('Under review')}}</span>
                            </p>


                        @elseif($user->kyc_address_link != null && $user->kyc_address_status==1)
                            <p>
                                Status:
                                <span class="badge badge-success bg-success mb-3">{{__('Approved')}}</span>
                            </p>


                        @elseif($user->kyc_address_link==null && $user->kyc_address_status==2)
                            <p>
                                Status:
                                <span class="badge badge-primary bg-danger mb-3">Declined: {{$user->kyc_address_reason}}</span>
                            </p>
                        @endif
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
@stop
