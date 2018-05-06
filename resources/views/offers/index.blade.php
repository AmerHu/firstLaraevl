@extends('layouts.app')
@section('header')
    <h2> <a href="/offers/admin">Offers</a></h2>
@endsection

@section('content')
    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/offers/create'>Offers New User</a>
        </div>
    </div>
    <br/>
    <div class="row">

        @foreach($offers as $offer)
            @include('offers.offer')
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        @endforeach

    </div>
    <div class="row">
        <div class="text-center">
            {{$offers->links()}}
        </div>
    </div>
@endsection
