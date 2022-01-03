@extends('layouts.user')

@section('content')
<div class="container">
    <div class="page-content mt-3">
        <!-- ============================================================== -->
        @include('includes.balance')
        <!-- Pay, topup transfer -->
        <!-- ============================================================== -->
        <div class="card-group">
            <div class="card p-2 p-lg-3">
                <a href="{{ route('QRPayment') }}">
                    <div class="p-lg-3 p-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-circle btn-danger text-white btn-lg" href="javascript:void(0)">
                                <i class="ti-clipboard"></i>
                            </button>
                            <div class="ms-4" style="width: 38%">
                                <h4 class="fw-normal">QR Pay</h4>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="card p-2 p-lg-3">
                <a href="{{ route('fund') }}">
                    <div class="p-lg-3 p-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-circle btn-cyan text-white btn-lg" href="javascript:void(0)">
                                <i class="ti-wallet"></i>
                            </button>
                            <div class="ms-4" style="width: 38%">
                                <h4 class="fw-normal">Top up</h4>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="card p-2 p-lg-3">
                <a href="{{ route('transfer') }}">
                    <div class="p-lg-3 p-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                                <i class="fas fa-history"></i>
                            </button>
                            <div class="ms-4" style="width: 38%">
                                <h4 class="fw-normal">Transfer</h4>
                            </div>

                        </div>
                    </div>
                </a>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0" style="margin-left: -15px">Recent transactions</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <tbody>
                            @if(!empty($transactions) && count($transactions) > 0)
                                @foreach($transactions as $transaction)
                                    <tr style="margin-bottom: 2px;">
                                        <td class="{{ $transaction->txn_type == 'credit'?'left-border-success':'left-border-danger' }}">
                                            <h5 class="font-weight-medium mb-0">
                                                <span class="text-capitalize">{{ $transaction->purpose }}</span>
                                            </h5>
                                            <span class="text-muted">{{ $transaction->created_at->toDayDateTimeString() }}</span>
                                        </td>
                                        <td style="text-align: right;margin-right: 15px">
                                            <span class="text-right {{ $transaction->txn_type == 'credit'?'text-success':'text-danger' }}">
                                                {{ $transaction->txn_type == 'credit'?'+':'-' }}
                                                ₦{{ number_format($transaction->amount, '2', '.', ',') }}</span>
                                        </td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td style="border-left: 2px solid red; padding-left: 10px">--}}
{{--                                            <h5 class="font-weight-medium mb-0">--}}
{{--                                                Daniel Kristeen--}}
{{--                                            </h5>--}}
{{--                                            <span class="text-muted">Texas, Unitedd states</span>--}}
{{--                                        </td>--}}
{{--                                        <td style="text-align: right;margin-right: 5px">--}}
{{--                                            <span class="text-right">Visual Designer</span><br>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                @endforeach
                            @else
                                <tr><td colspan="2">No transations yet</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
