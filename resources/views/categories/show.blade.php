@extends('layouts.app')
@section('header')
    <h2> <a href="/category/admin">Categories</a></h2>
@endsection
@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-6">
            <h4>Name AR :{{ json_decode($category->name, true)['AR'] }}</h4>
            <h4>Name EN :{{ json_decode($category->name, true)['EN'] }}</h4>
        </div>
        <div class="col-md-6">
            <img src="/{{ $category->img }}" style="height:  60%">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-primary btn-block" type="button" href="/category/edit/{{$category->id}}">edit</a>
        </div>
    </div>
@endsection
