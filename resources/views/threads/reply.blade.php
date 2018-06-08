@foreach($replies as $reply)
    <div class="row">

        <div class="col-sm-8">
            <div class="card">

                <div class="card-header"><a href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</div>

                <div class="card-body">{{ $reply->body }}</div>
            </div>
        </div>
    </div> <br>
@endforeach
{{ $replies->links() }}
