@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top:10px;">
                @component('components.card',['title'=>'Add A New Thread'])

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin:0;">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{route('threads.store')}}">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="body">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="id" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endcomponent
            </div>
        </div>
    </div>
@endsection
