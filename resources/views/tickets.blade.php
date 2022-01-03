@extends('layouts.user')
{{--@section('page')--}}
{{--   Support / Tickets--}}
{{--@endsection--}}
@section('content')
    <div class="container-fluid">
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
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="d-md-flex mb-3">
                            <h3 class="box-title mb-0">Support ticket</h3>
                            <div class="col-md-2 col-sm-4 col-xs-6 ms-auto">
                                <a href="{{ route('ticket.create') }}"
                                   class="fw-normal btn btn-success pull-right ms-3 waves-effect waves-light text-white">Create ticket</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap">
                                <thead>
                                <tr>

                                    <th class="border-top-0">Ticket Id</th>
{{--                                    <th class="border-top-0">Title</th>--}}
{{--                                    <th class="border-top-0">Body</th>--}}
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($tickets) && count($tickets) > 0)
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td scope="row" class="txt-oflo">#{{$ticket['ticket_id']}}</td>
{{--                                            <td>{{ $ticket['title'] }}</td>--}}
{{--                                            <td>{{ $ticket['message'] }}</td>--}}
                                            <td>
                                                @if($ticket['status'] == 'inprogress')
                                                    <span class="badge bg-warning">In progress</span>
                                                @elseif($ticket['status'] == 'open')
                                                    <span class="badge bg-success">Open</span>
                                                @elseif($ticket['status'] == 'closed')
                                                    <span class="badge bg-danger">Closed</span>
                                                @endif</td>
                                            <td>{{ $ticket['created_at'] }}</td>
                                            <td>
                                                <a href="{{ route('ticket.show', $ticket['ticket_id']) }}" class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <div class="d-flex justify-content-center">No tickets yet</div>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
