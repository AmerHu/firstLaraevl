@extends('layouts.app')
@section('header')
    <h2><a href="/extra/admin">Extra Items</a></h2>
@endsection
@section('content')

    <div class="col-md-7">
        <h4>Name EN : {{ json_decode($extra->name, true)['EN'] }}</h4><br/>
        <h4>Name AR : {{ json_decode($extra->name, true)['AR'] }}</h4><br/>
        <h4>Price : {{ $extra->price}}</h4><br/>


        <h3>Related Category</h3><br/>
        @foreach($categories as $category)
            <div class="row">
                <div class="col-md-10">
                    <h4>{{ json_decode($category->name, true)['EN'] }}</h4>
                </div>
                <div class="col-md-2">
                    <a href="/cateExtra/delete/{{$category->id}}/{{ $extra->id}}"
                       class="btn btn-danger" type="button"
                       onclick="return confirm('Are you sure you want to delete this Relabeled?')">X</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-3">
        <a class="btn btn-primary btn-block" type="button" href="/extra/edit/{{$extra->id}}">edit</a>
        <a class="btn btn-primary btn-block" type="button" href="/cateExtra/create/{{$extra->id}}">Add to Category</a>
    </div>

@endsection