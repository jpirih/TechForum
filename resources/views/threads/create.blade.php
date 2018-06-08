@extends('layouts.app')

@section('content')
    <div class="row row-justify-content-center">
        <div class="col-sm-12 text-center">
            <h1>Publish Thread</h1>
        </div>
    </div> <!-- main page title -->

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card card-body">
                <form action="/threads" method="post" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Thread Title -->
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title')}}">
                        </div>
                    </div>
                    <!-- Select channel -->
                    <div class="form-group row">
                        <label for="channel_id" class="col-sm-4 form-label">Select Channel</label>
                        <div class="col-sm-8">
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value="">Select one...</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Thread body -->
                    <div class="form-group row">
                        <label for="body" class="col-sm-4 col-form-label">Body</label>
                        <div class="col-sm-8">
                            <textarea name="body" rows="5" class="form-control" id="body"> {{ old('body') }} </textarea>
                        </div>
                    </div>

                    <!-- submit button -->
                    <div class="form-group row justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </div>

                    <!-- errors -->
                    @if(count($errors))
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
