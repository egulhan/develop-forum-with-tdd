<div class="row justify-content-center" style="margin-top:10px;">
    <div class="col-md-8">
        @component('components.card')
            @slot('title')
                {{$reply->owner->name}} said at {{$reply->created_at->diffForHumans()}}
            @endslot
            @slot('body')
                    {{$reply->body}}
            @endslot
        @endcomponent
    </div>
</div>
