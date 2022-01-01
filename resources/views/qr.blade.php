@extends('layouts.user')

@section('content')
    <div class="container">
        @include('includes.feedback')
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card w-100 mt-5">
                    <div class="card-body text-center">
                        <video id="video" width="600" height="480" autoplay></video>
                        <h4 class="card-title">Scan to pay</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/qr.js') }}"></script>
@endsection
