@extends('layouts.app')

@section('content')
   @foreach($discussions as $d )
      <div class="panel panel-default">
          <div class="panel-heading">
              <img src="{{$d->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
              <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>

              {{--<span class="btn btn pull-right btn-success btn-xs">CLOSE</span>--}}
              @if($d->hasBestAnswer())
                  <span class="btn btn pull-right btn-success btn-xs">close</span>

              @else
                  <span class="btn btn pull-right btn-danger btn-xs">open</span>
               @endif
              <a href="{{ route('discussion', ['slug' =>$d->slug]) }}" class="btn btn-default btn-xs pull-right">View</a>
          </div>
              <div class="panel-body">
                  <h4 class="text-center">
                     <b> {{ $d->title }}</b>
                  </h4>
                  <p class="text-center">
                      {{ str_limit($d->content, 100) }}
                  </p>
              </div>

      </div>

       <div class="panel-footer">
           <span>
               {{ $d->replies->count() }} Replies
           </span>
           <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="pull-right btn btn-success btn-xs">{{ $d->channel->title }}</a>
       </div>

    @endforeach

    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection


