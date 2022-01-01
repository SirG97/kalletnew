@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="page-content mt-3">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
            <!-- ============================================================== -->
            <!-- Balance -->
            <!-- ============================================================== -->
            <div class="card-group">
                <div class="card p-2 p-lg-3">
                    <div class="p-lg-3 p-2">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                                <i class="fas fa-dollar-sign"></i>
                            </button>
                            <div class="ms-4" style="width: 38%">
                                <h4 class="fw-normal">Balance</h4>
                            </div>
                            <div class="ms-auto">
                                <h2 class="display-7 mb-0">NGN{{ $balance }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Pay, topup transfer -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Top up</h4>
                            <h5 class="card-subtitle mb-3 pb-3 ">
                                Fund your wallet
                            </h5>
                            <form class="" method="POST" action="{{ route('fund.initialize') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="amount" class="form-control" placeholder="Amount">
                                    <label>Amount</label>
                                </div>
                                <div class="d-md-flex align-items-center">
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <button type="submit" class="btn btn-primary font-weight-medium rounded-pill px-4">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                                Proceed
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://js.paystack.co/v1/inline.js"></script>
@endsection
