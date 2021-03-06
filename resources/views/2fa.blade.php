@extends('layouts.user')

@section('content')
<div class="container-fluid mt--6">
    @include('includes.feedback')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header checkx">
            <h3 class="mb-0 text-dark">{{__('Two-Factor Security Option')}}</h3>
          </div>
          <div class="card-body">
            <div class="align-item-sm-center flex-sm-nowrap text-left">
                <p class="text-sm text-dark">
                {{__('Two-factor authentication is a method for protection your web account.
                  When it is activated you need to enter not only your password, but also a special code.
                  You can receive this code by in mobile app.
                  Even if a third person finds your password, then can\'t access your account with that code.')}}
                </p>
               <div class=""> Status:
                   <span class="badge badge-pill badge-primary mb-3" >
                      @if($user->fa_status==0)
                      {{__('Disabled')}}
                      @else
                      {{__('Active')}}
                      @endif
                    </span>
               </div>
                <ul class="text-default text-sm">
                  <li>{{__('Install any of this (Google, Duo Mobile, Microsoft, FreeOTP, Authy, Yandex.Key) authentication app on your device. Or any app that supports the Time-based One-Time Password (TOTP) protocol should work.')}}</li>
                  <li>{{__('Use the authenticator app to scan the barcode below.')}}</li>
                  <li>{{__('Enter the code generated by the authenticator app.')}}</li>
                </ul>
                <a data-toggle="modal" data-target="#modal-form2fa" href="#" class="btn btn-radius btn-primary text-white">
                @if($user->fa_status==0)
                  {{__('Enable 2fa')}}
                @elseif($user->fa_status==1)
                  {{__('Disable 2fa')}}
                @endif
                </a>
                <div class="modal fade" id="modal-form2fa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-body text-center">
                          @if($user->fa_status==0)
                            <img src="{{$data['image']}}" class="mb-3 user-profile">
                          @endif
                          <form action="{{route('2fa.toggle')}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <div class="col-lg-12">
                                <input type="text" pattern="\d*" name="code" class="form-control" minlength="6" maxlength="6" placeholder="Six digit code" required>
                                  <input type="hidden"  name="vv" value="{{$data['secret']}}">
                                @if($user->fa_status==0)
                                  <input type="hidden"  name="type" value="1">
                                @elseif($user->fa_status==1)
                                  <input type="hidden"  name="type" value="0">
                                @endif
                              </div>
                            </div>
                            <div class="text-right">
                              <button type="submit"  class="btn btn-neutral btn-radius btn-block">
                              @if($user->fa_status==0)
                                {{__('Enable 2fa')}}
                              @elseif($user->fa_status==1)
                                {{__('Disable 2fa')}}
                              @endif
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
