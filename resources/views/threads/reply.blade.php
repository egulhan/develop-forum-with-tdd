<div style="margin-top:10px;">
    @component('components.card')
        @slot('title')
            <div class="row">
                <div class="col-md-9">
                    <h5>
                        {{$reply->owner->name}} said at {{$reply->created_at->diffForHumans()}}
                    </h5>
                </div>
                <div class="col-md-3">
                    <form action="{{route('replies.favorite',['id'=>$reply->id])}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" {{$reply->isFavorited() ? 'disabled' : ''}}>
                            {{$reply->favorites()->count().' '.str_plural('Favorite',$reply->favorites()->count())}}
                        </button>
                    </form>
                </div>
            </div>
        @endslot
        @slot('body')
            {{$reply->body}}
        @endslot
    @endcomponent
</div>
