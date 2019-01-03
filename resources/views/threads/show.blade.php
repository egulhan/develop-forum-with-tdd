@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$thread->title}}</div>

                    <div class="card-body">
                        <div class="body">{{$thread->body}}</div>
                    </div>
                </div>
            </div>
        </div>


        @foreach($thread->replies as $reply)
            <div class="row justify-content-center" style="margin-top:10px;">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{$reply->owner->name}} said at {{$reply->created_at->diffForHumans()}}</div>

                        <div class="card-body">
                            <div class="body">{{$reply->body}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
