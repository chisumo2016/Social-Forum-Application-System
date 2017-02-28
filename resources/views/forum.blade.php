@extends('layouts.app')

@section('content')
   @foreach($discussions as $d )
      <div class="panel panel-default">
          <div class="panel-heading">
              <img src="{{$d->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
              <span>{{ $d->user->name }}</span>
              <a href="{{ route('discussion', ['slug' =>$d->slug]) }}" class="btn btn-default pull-right">View</a>
          </div>
              <div class="panel-body">
                  <h5 class="text-center">
                      {{ $d->title }}
                  </h5>
                  <p class="text-center">
                      {{ str_limit($d->content, 50) }}
                  </p>
              </div>

      </div>

       <div class="panel-footer">
           <p>
               {{ $d->replies->count() }} Replies
           </p>
       </div>

    @endforeach

    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection


