@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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

                @auth
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
                @endauth

                @guest
                    <div class="text-center" style="margin-top:10px;padding: 30px;">
                        Please <a href="{{route('login')}}">login</a> to add comment
                    </div>
                @endguest

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                <div style="margin-top:15px;">
                    {{$replies->links()}}
                </div>
            </div>

            <div class="col-md-4">
                @component('components.card')
                    @slot('body')
                        <ul>
                            <li>Published {{$thread->created_at->diffForHumans()}}</li>
                            <li>Created by <a href="#">{{$thread->owner->name}}</a></li>
                            <li>It
                                has {{$thread->replies()->count()}} {{str_plural('comment',$thread->replies()->count())}}</li>
                        </ul>
                    @endslot
                @endcomponent
            </div>

        </div>
    </div>
@endsection
