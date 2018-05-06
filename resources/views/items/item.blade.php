<div class="col-md-5">
    <h3>English Name : <a href="/items/show/{{ $item->id}}">{{ json_decode($item->name, true)['EN'] }}</a></h3>
    <h3>Arabic Name : {{ json_decode($item->name, true)['AR'] }}</h3>
</div>

<div class="col-md-3">
    <img src="/{{$item->img}}" style="width: 100%">
</div>
<div class="col-md-4 text-center">
    @if($item->active == 1)
        <a href="/items/delete/{{$item->id}}/0"
           onclick="return confirm('Are you sure you want to deactivate this Items ?')">
            <img src="/images/check.svg" style="width: 34%;"></a>

    @endif
    @if($item->active == 0)
        <a href="/items/delete/{{$item->id}}/1"
           onclick="return confirm('Are you sure you want to active this Items ?')">
            <img src="/images/red-x-icon-transparent-background-6.png" style="
            width: 30%;
                 margin-bottom: 2%;
                 margin-top: 2%;">
        </a>
    @endif
    <br/>
    <br/>
    <br/>
</div>

