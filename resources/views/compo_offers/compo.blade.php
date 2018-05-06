<div class="col-md-5">
    <h3>English Name : <a href="/compo/show/{{ $compo->id}}">{{ json_decode($compo->name, true)['EN'] }}</a></h3>
    <h3>Arabic Name : {{ json_decode($compo->name, true)['AR'] }}</h3>
</div>
<div class="col-md-3">
    <img src="/{{$compo->img}}" style="width:80%">
</div>
<div class="col-md-4 text-center">
    @if($compo->active == 1)
        <a href="/compo/delete/{{$compo->id}}/0"
           onclick="return confirm('Are you sure you want to deactivate this Category ?')">
            <img src="/images/check.svg" style="     margin-top: 4%;
    width: 22%;"></a>

    @endif
    @if($compo->active == 0)
        <a href="/compo/delete/{{$compo->id}}/1"
           onclick="return confirm('Are you sure you want to active this Category ?')">
            <img src="/images/red-x-icon-transparent-background-6.png" style="margin-top: 4%;
    width: 22%;">
        </a>
    @endif
</div>
