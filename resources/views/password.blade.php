@extends('layouts.user')

@section('content')
<div class="container-fluid mt--6">
{{--  <div class="content-wrapper">--}}
    @include('includes.feedback')
    <div class="row">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header checkx">
                <h5 class="mb-0 text-dark font-weight-bolder">{{__('Password')}}</h5>
            </div>
          <div class="card-body">
            <form action="{{route('password.change')}}" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <input type="password" id="old_password" name="old_password" class="form-control" placeholder="{{__('Current password')}}" required>
                    <label for="old_password">{{__('Current password')}}</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="{{__('New password')}}" required>
                    <label for="password">{{__('New password')}}</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{__('Confirm password')}}" required>
                    <label for="password_confirmation">{{__('Confirm password')}}</label>
                </div>

                <h4 class="mb-0 text-dark font-weight-bolder">{{__('Password requirements')}}</h4>
                <p class="mb-2 text-default text-sm">{{__('Ensure that these requirements are met')}}</p>
                <ul class="text-default text-sm">
                  <li>{{__('Minimum 8 characters long - the more, the better')}}</li>
                  <li>{{__('At least one lowercase character.')}}</li>
                  <li>{{__('At least one uppercase character.')}}</li>
                  <li>{{__('At least one number, symbol, or whitespace character.')}}</li>
                </ul>
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-radius btn-lg text-white" id="update_password">{{__('Update Password')}}</button>
                </div>
            </form>
          </div>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="mb-0 text-dark font-weight-bolder">{{__('Devices')}}</h5>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                            <tr>
                                <th>{{__('S/N')}}</th>
                                <th>{{__('IP Address')}}</th>
                                <th>{{__('Browser')}}</th>
                                <th>{{__('Login at')}}</th>
                                <th>{{__('Successful')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devices as $k => $device)
                                <tr>
                                    <td>{{ ++$k }}</td>
                                    <td>{{ $device['ip_address'] }}.</td>
                                    <td>{{ $device['user_agent'] }}</td>
                                    <td>{{date("Y/m/d h:i a", strtotime($device['login_at']))}}</td>
                                    <td>{{$device['login_successful'] == 1 ? 'Yes': 'No'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
