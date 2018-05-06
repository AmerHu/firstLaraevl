@extends('layouts.app')
@section('header')
    <h2><a href="/items/admin">Items</a></h2>
@endsection
@section('content')

    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/items/create'>Create New Items</a>
        </div>
    </div>
    <br/>
    <div class="row">
        @foreach($items as $item)
            @include('items.item')

        @endforeach
    </div>

@endsection
