@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('components.card')
                    @slot('title')
                        <a href="#">{{$thread->owner->name}}</a> posted:
                        {{$thread->title}}
                    @endslot
                    @slot('body')
                        {{$thread->body}}
                    @endslot
                @endcomponent
            </div>
        </div>

        @foreach($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
    </div>
@endsection
