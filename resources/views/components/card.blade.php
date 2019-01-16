<div class="card">
    <div class="card-header">{{$title}}</div>

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
