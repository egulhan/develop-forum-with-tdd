<div class="card">
    @if(isset($title))
        <div class="card-header">{{$title}}</div>
    @endif

    <div class="card-body">
        <div class="body">
            @if(isset($body))
                {{$body}}
            @else
                {{$slot}}
            @endif
        </div>
    </div>
</div>
