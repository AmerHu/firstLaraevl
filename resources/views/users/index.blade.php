@extends('layouts.app')
@section('header')
    <h2>Users</h2>
@endsection

@section('content')
    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/user/create'>Create New User</a>
        </div>
    </div>
    <br/>
    @foreach($users as $user)
        @include('users.user')
        <br>
    @endforeach
    <div class="row">
        <div class="text-center">
            {{$users->links()}}
        </div>
    </div>
@endsection
