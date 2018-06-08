@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- main title -->
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h1>Larael Forum </h1>
            </div>
        </div>
        <br><!-- end of main title -->
        <div class="row col-sm-8 justify-content-center">

                @foreach($threads as $thread)
                    <div class="card">
                        <div class="card-header"><h4><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4></div>

                        <div class="card-body">{{ $thread->body }}/div>
                    </div>
                        <br>
                @endforeach

        </div>
    </div>
@endsection
