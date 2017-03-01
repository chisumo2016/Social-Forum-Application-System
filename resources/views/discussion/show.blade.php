@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{$d->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
            <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>

           @if($d->is_being_watched_by_auth_user())

                <a href="{{ route('discussion.unwatch', ['id' =>$d->id]) }}" class="btn btn-default btn-xs pull-right">Unwatch</a>
           @else

                <a href="{{ route('discussion.watch', ['id' =>$d->id]) }}" class="btn btn-default btn-xs pull-right">Watch</a>
          @endif

        </div>
        <div class="panel-body">
            <h4 class="text-center">
                <b> {{ $d->title }}</b>
            </h4>

            <hr>
            <p class="text-center">
                 {{ $d->content }}
            </p>
        </div>

    </div>

    <div class="panel-footer">
       <span>
               {{ $d->replies->count() }} Replies
           </span>
        <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="pull-right btn btn-success btn-xs">{{ $d->channel->title }}</a>
    </div>


    @foreach($d->replies as $r)

        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$r->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
                <span>{{ $r->user->name }}, <b>{{ $r->created_at->diffForHumans() }}</b></span>

            </div>

            <div class="panel-body">


                <hr>
                <p class="text-center">
                    {{ $r->content }}
                </p>
            </div>

        </div>

        <div class="panel-footer">
            <p>
                @if($r->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike', ['id' => $r->id]) }}" class="btn btn-danger">Unlike <span class="badge">{{ $r->likes->count() }}</span></a>

               @else
                    <a href="{{ route('reply.like', ['id' => $r->id]) }}" class="btn btn-success btn-xs">Like <span class="badge">{{ $r->likes->count() }}</span></a>

                @endif
            </p>
        </div>
    @endforeach
    <div class="div panel panel-default">
        <div class="panel-body">
            @if(Auth::check())
                <form action="{{ route('discussion.reply', ['id' =>$d->id]) }}" method="post">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="reply">Leave a reply  ....</label>
                        <textarea  cols="30" rows="10" class="form-control" id="reply" name="reply"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn pull-right">Leave a reply</button>
                    </div>
                </form>
           @else

            <div class="text-center">
                <h2>Sign in to leave a reply</h2>
            </div>
          @endif
        </div>
    </div>

@endsection
