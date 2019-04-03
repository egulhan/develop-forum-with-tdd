@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Threads</div>

                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4><a href="{{$thread->path()}}">{{$thread->title}}</a></h4>
                                    </div>
                                    <div class="col-md-2">
                                        {{$thread->replies_count.' '.str_plural('reply',$thread->replies_count)}}
                                    </div>
                                </div>
                                <div class="body">{{$thread->body}}</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
