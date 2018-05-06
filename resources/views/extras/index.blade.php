@extends('layouts.app')
@section('header')
    <h2> <a href="/extra/admin">Extra Items</a></h2>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="offset-7 col-md-3">
            <a class="btn btn-primary btn-block" type="button" href='/extra/create'> New Extra</a>

        </div>
    </div>
    <hr/>
    <div class="row">
        @foreach($extras as $extra)
            @include('extras.extra')
            <hr/>
        @endforeach
    </div>
@endsection
