@extends('layouts.app')
@section('header')
    <h2> <a href="/desc/admin">Description</a></h2>
@endsection



@section('content')
    @include('flash::message')
    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/desc/create'> New Description</a>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
        @foreach($descriptions as $description)
            @include('descriptions.description')

        @endforeach
    </div>
@endsection
