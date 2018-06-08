@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- main title -->
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h1>Larael Forum </h1>
            </div>
            <br>
        </div> <!-- end of main title -->
        <div class="row">

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header"><h4><a href="#">{{ $thread->owner->name }}</a> posted {{ $thread->title }}
                        </h4></div>

                    <div class="card-body">{{ $thread->body }}</div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-body">
                    <!-- thread meta data -->
                    This Thread was posted {{ $thread->created_at->diffForHumans() }}
                    by {{ $thread->owner->name }} and
                    has {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                </div>
            </div> <!-- end of meta data column -->

        </div> <!-- end of form thread -->
        <br>

        <h3>Replies</h3>
        <hr>
    @include('threads.reply') <!-- replies list  -->

        <!-- add reply you need tgo be registered  -->
        @if(auth()->check())
            <div class="row">
                <div class="col-sm-8">
                    <form action="{{ $thread->path() }}/replies" method="post">
                    {{ csrf_field() }}

                    <!-- Reply body -->
                        <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="5" class="form-control"
                              placeholder="Have something to say?"></textarea>
                        </div>
                        <!-- submit button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Post</button>

                        </div>
                    </form>
                </div> <!-- end add reply form -->

            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
            </p>

        @endif

    </div>


@endsection
