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

            <div class="col-md-8" style="margin-top:10px;">
                @component('components.card',['title'=>'Reply'])

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin:0;">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{route('threads.reply',['id'=>$thread->id])}}">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea class="form-control" name="body" id="id" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endcomponent
            </div>
        </div>

        @foreach($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
    </div>
@endsection
