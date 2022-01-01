@extends('layouts.user')
@section('page')
    New Ticket
@endsection
@section('content')
    <div class="container-fluid">
       @include('includes.feedback')
        <div class="row">

            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="POST" action="{{ route('ticket.store') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="amount" class="col-md-12 p-0">Title</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" placeholder="Ticket Title" class="form-control p-0 border-0" name="title" id="title" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Category</label>

                                <div class="col-sm-12 border-bottom">
                                    <select name="category" class="form-select shadow-none p-0 border-0 form-control-line">
                                        @if(!empty($categories) && count($categories) > 0)
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" > {{ $category->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>No categories</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="col-sm-12">Coin network</label>

                                <div class="col-sm-12 border-bottom">
                                    <select name="priority" id="coin_network" required="" class="form-select shadow-none p-0 border-0 form-control-line">
                                        <option value="low" selected>Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Message</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <textarea name="message" rows="5" class="form-control p-0 border-0"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Create Ticket</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection
