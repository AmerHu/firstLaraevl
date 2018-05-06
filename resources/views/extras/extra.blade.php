
<div class="col-md-7">
    <h4>Name EN :<a href="/extra/show/{{$extra->id}}">{{ json_decode($extra->name, true)['EN'] }}</a> </h4><br/>
    <h4>Name AR : {{ json_decode($extra->name, true)['AR'] }}</h4><br/>
</div>




<div class="col-md-3">
    <a class="btn btn-primary btn-block" type="button" href="/extra/edit/{{$extra->id}}">edit</a>
</div>
<div class="col-md-2 text-center">
    @if($extra->active == 1)
        <a href="/extra/delete/{{$extra->id}}/0"
           onclick="return confirm('Are you sure you want to deactivate this Extra ?')">

            <img src="/images/check.svg" style="width:20% ">
        </a>

    @endif
    @if($extra->active == 0)
        <a href="/extra/delete/{{$extra->id}}/1"
           onclick="return confirm('Are you sure you want to active this Extra ?')">
            <img src="/images/red-x-icon-transparent-background-6.png" style="width:20% ">
        </a>
    @endif
</div>
<hr/>