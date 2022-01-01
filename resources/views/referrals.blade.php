@extends('layouts.user')
@section('content')
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 text-dark font-weight-bolder">{{__('Affiliate Earnings')}}</h5>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table table-flush" id="datatable-buttons">
                                <thead>
                                <tr>
                                    <th>{{__('S / N')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('From')}}</th>
                                    <th>{{__('Created')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['earning'] as $k=>$val)
                                    <tr>
                                        <td>{{++$k}}.</td>
                                        <td>{{$currency->symbol.number_format($val->amount)}}</td>
                                        <td>@if($val->ref_id!=null){{$val->shared['first_name']}} {{$val->shared['last_name']}} @else [Account Deleted]@endif</td>
                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
{{--                    @if($set->referral==1)--}}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="card-title mb-0 font-weight-bolder">{{__('Affiliate Bonus')}}</h4>
                                        <span class="mb-0 text-dark">{{number_format( auth()->user()->ref_bonus, 2)}}</span>
                                        {{--                <span class="mb-0 text-dark">{{$currency->symbol.number_format($user->ref_bonus)}}</span>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">{{__('Affiliate link')}}</h4>
                                <p class="text-dark text-sm">{{__('Refer new users or merchants with your referral code and earn 0.1% on the revenue Kallet makes on each transaction')}}</p>
{{--                                @if($set->referral_type=="username")--}}
{{--                                    <span class="text-dark text-sm">{{$user->username}}</span><br>--}}
{{--                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="{{$user->username}}" title="Copy">{{__('Copy')}}</button>--}}
{{--                                @else--}}
                                    <span class="text-dark text-sm">{{ auth()->user()->referral_link }}</span><br>
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="{{ auth()->user()->referral_link }}" title="Copy">{{__('Copy')}}</button>
{{--                                @endif--}}
                            </div>
                        </div>
{{--                    @endif--}}
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mb-0">Referrals</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                @foreach($data['referral'] as $k=>$val)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{url('/')}}/asset/profile/{{$val['image']}}" class="avatar rounded-circle mr-3">
                                        </td>
                                        <td>
                                            {{$val->first_name}} {{$val->last_name}}
                                        </td>
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
@stop
