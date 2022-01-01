@extends('layouts.user')
@section('page')
    Ticket
@endsection
@section('content')
<div class="container-fluid">
    @include('includes.feedback')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $ticket->title }}</h4>
                  {{ $ticket->message }}
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="height: 500px; overflow-y: auto">
                    <h4 class="card-title">Ticket Replies</h4>

                    <ul class="chat-list chat" >
                        @foreach($ticket->comments as $comment)
                            <!--chat Row -->
                                @if($comment->user == NULL)
                                <li class="mt-4">
        {{--                            <div class="chat-img d-inline-block align-top">--}}
        {{--                                <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle">--}}
        {{--                            </div>--}}
                                    <div class="chat-content  d-inline-block">
                                        <h5 class="text-muted fs-3 font-weight-medium">{{ $comment->admin->name }}</h5>
                                        <div class="box mb-2 d-inline-block text-dark message font-weight-medium fs-3 bg-light-info">
                                            {{ $comment->comment }}
                                        </div>
                                    </div>
                                    <div class="">
                                        {{ $comment->created_at->toFormattedDateString() }}
                                    </div>
                                </li>
                                @elseif($comment->admin == NULL)
                                <!--chat Row -->
                                <li class="odd mt-4">
                                    <div class="chat-content ps-3 d-inline-block text-end">
                                        <h5 class="text-muted fs-3 font-weight-medium">{{ $comment->user->name }}</h5>

                                        <div class="box mb-2 d-inline-block text-dark message font-weight-medium fs-3 bg-light-success">
                                            {{ $comment->comment }}
                                        </div>
                                        <div> {{ $comment->created_at->toFormattedDateString() }}</div>
                                    </div>

                                </li>
                                @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Write a reply</h4>
                    <form method="post" action="{{ route('ticket.comment') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group mb-4">
{{--                            <label class="col-md-12 p-0">O</label>--}}
                            <input type="hidden" value="{{ $ticket->id }}" name="id">
                            <div class="col-md-12 border-bottom p-0">
                                <textarea rows="5" class="form-control p-0 border-0" name="comment"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn waves-effect waves-light btn-success">
                            Reply
                        </button>
{{--                        <button type="button" class="mt-3 btn waves-effect waves-light btn-info">--}}
{{--                            Reply &amp; close--}}
{{--                        </button>--}}
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Ticket Info</h4>
                </div>
                <div class="card-body bg-extra-light">
                    <div class="row text-center">
                        <div class="col-6 my-2 text-start">
                            @if($ticket->status == 'inprogress')
                                <span class="badge bg-warning">In progress</span>
                            @elseif($ticket->status == 'open')
                                <span class="badge bg-success">Open</span>
                            @elseif($ticket->status == 'closed')
                                <span class="badge bg-danger">Closed</span>
                            @endif

                        </div>
                        <div class="col-6 my-2">{{ $ticket->created_at->toFormattedDateString() }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="pt-3">Ticket ID</h5>
                    <span>#{{ $ticket->ticket_id }}</span>
                    <h5 class="mt-4">Support Staff</h5>
                    <span>Agent Name</span>
                    <br>
                    <button type="button" class="mt-3 btn waves-effect waves-light btn-success">
                        Update
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title">User Info</h4>
                    <div class="profile-pic mb-3 mt-3">
{{--                        <img src="../../assets/images/users/5.jpg" width="150" class="rounded-circle" alt="user">--}}
                        <h4 class="mt-3 mb-0">{{ $ticket->user->name }}</h4>
                        <a href="mailto:{{ $ticket->user->email}}">{{ $ticket->user->email }}</a>
                    </div>
                    <div class="row text-center mt-5">
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $totalTicket }}</h3>
                            <h6>Total</h6>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $openTicket }}</h3>
                            <h6>Open</h6>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $closedTicket }}</h3>
                            <h6>Closed</h6>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection()
