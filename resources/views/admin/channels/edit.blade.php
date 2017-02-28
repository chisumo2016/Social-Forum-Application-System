@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Edit Channel: {{ $channel->title }}</div>

        <div class="panel-body">
            <form action="{{ route('channels.update', ['channel'=> $channel->id]) }}" method="post">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <input type="text" name="channel" class="form-control" value="{{ $channel->title }}">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            update channel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection