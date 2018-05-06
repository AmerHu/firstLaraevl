@extends('layouts.app')
@section('header')
    <h2>Users</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Name : {{ json_decode($user->name, true)['EN'] }}</h3>
            <h3>Email : {{ $user->email}}</h3>
            <h3>Type : {{ $userType }}</h3>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary btn-block" type="button" href="/user/edit/{{$user->id}}">edit</a>
        </div>
    </div>
@endsection
