@extends('layouts.app')

@section('header')
    <h2><a href="/category/admin">Categories</a></h2>
@endsection

@section('content')
    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/category/create'> New Categories</a>
        </div>
    </div>
    <br/>

    @foreach($categories as $category)

            @include('categories.category')

    @endforeach

@endsection
