<div class="col-md-4">
    <h3>Name : <a href="/offers/show/{{ $offer->id}}">  {{ json_decode($offer->name, true)['EN'] }}
           </a></h3>
    <h4>Name AR : {{ json_decode($offer->name, true)['AR'] }}</h4>
</div>

<div class="col-md-4">
    <img src="/{{$offer->img}}" style="height: 200px">
</div>
<div class="col-md-4 text-center">
    @if($offer->active == 1)
        <a  href="/offers/delete/{{$offer->id}}/0"
            onclick="return confirm('Are you sure you want to deactivate this Offer ?')">
            <img src="/images/red-x-icon-transparent-background-6.png" style="margin-top: 7%;width: 25%;;"></a>

    @endif
    @if($offer->active == 0)
        <a href="/offers/delete/{{$offer->id}}/1"
           onclick="return confirm('Are you sure you want to active this Offer ?')">
            <img src="/images/check.svg" style="margin-top: 7%;
    width: 25%;"></a>
    @endif
</div>


