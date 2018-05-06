<div class="row">
    <div class="col-md-4">
        <h5>
            <lable>English Name :</lable>
            <a href="/category/show/{{$category->id}}">{{ json_decode($category->name, true)['EN'] }} </a>
        </h5>
    </div>
    <div class="col-md-4">
        <img src="/{{ $category->img }}" style=" max-width: 60%;">
    </div>
    <div class="col-md-4 text-center">
        @if($category->active == 1)
            <a href="/category/delete/{{$category->id}}/0"
               onclick="return confirm('Are you sure you want to deactivate this Category ?')">
                <img src="/images/check.svg" style=" margin-top: 5%;
    max-width: 25%;">
            </a>
        @endif
        @if($category->active == 0)
            <a href="/category/delete/{{$category->id}}/1"
               onclick="return confirm('Are you sure you want to active this Category ?')">
                <img src="/images/red-x-icon-transparent-background-6.png" style=" margin-top: 5%;
    max-width: 22%;">
            </a>
        @endif
        <br/>
    </div>
</div>
<br/>