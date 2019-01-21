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

            @auth
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

                        <form method="post" action="{{route('replies.store',['id'=>$thread->id])}}">

                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="body">Comment</label>
                                <textarea class="form-control" name="body" id="id" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endcomponent
                </div>
            @endauth

            @guest
                <div class="col-md-8 text-center" style="margin-top:10px;padding: 30px;">
                    Please <a href="{{route('login')}}">login</a> to add comment
                </div>
            @endguest

        </div>

        @foreach($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
    </div>
@endsection
