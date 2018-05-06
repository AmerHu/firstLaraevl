<div class="row">
    <div class="col-md-8">
        <h3>Name : <a href="/user/show/ {{ $user->id}}">{{ json_decode($user->name, true)['EN'] }}</a></h3>
        <h3>Email : {{ $user->email}}</h3>
    </div>
    <div class="col-md-4 text-center">
        @if($user->active == 1)
            <a  href="/user/delete/{{$user->id}}/0"
                onclick="return confirm('Are you sure you want to deactivate this User ?')">

                <img src="/images/check.svg" style="width:20% ">
            </a>

        @endif
        @if($user->active == 0)
            <a href="/user/delete/{{$user->id}}/1"
               onclick="return confirm('Are you sure you want to active this User ?')">
                <img src="/images/red-x-icon-transparent-background-6.png" style="width:20% ">
                </a>
        @endif
    </div>
</div>