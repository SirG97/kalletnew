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
            @include('includes.balance')
            <!-- ============================================================== -->
            <!-- Pay, topup transfer -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card w-100">
                        <div class="card-body">
                            <h4 class="card-title">Transfer Fund</h4>
                            <h5 class="card-subtitle mb-3 pb-3 ">
                                To another kallet account
                            </h5>
                            <form class="" method="POST" action="{{ route('transfer.store') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    <label>Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="amount" class="form-control" placeholder="Amount" required>
                                    <label>Amount</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                                    <label>Description</label>
                                </div>
                                <div class="d-md-flex align-items-center">
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <button type="submit" class="btn btn-primary font-weight-medium rounded-pill px-4" data-toggle="modal"
                                                data-target="#Pin">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                                Proceed
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div id="Pin" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                                <div class="modal-header d-flex align-items-center">
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        Enter 4 digit pin
                                                    </h4>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" value="" id="id" name="id">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="pin" class="form-control" placeholder="Pin" required>
                                                        <label for="pin">Pin</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="blockUserBtn" type="submit" class="btn btn-danger font-weight-medium text-white waves-effect">
                                                        Submit
                                                    </button>
                                                </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
