<div style="margin-top:10px;">
    @component('components.card')
        @slot('title')
            {{$reply->owner->name}} said at {{$reply->created_at->diffForHumans()}}
        @endslot
        @slot('body')
            {{$reply->body}}
        @endslot
    @endcomponent
</div>
