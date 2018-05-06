@extends('layouts.app')
@section('header')
    <h2> <a href="/compo/admin">Compo Offers</a></h2>
@endsection

@section('content')
    <div class="row">
        <div class="offset-8 col-md-4">
            <a class="btn btn-primary btn-block" type="button" href='/compo/create'>Offers New User</a>
        </div>
    </div>
    <br/>
    <div class="row">
        <br/>
        @foreach($compos as $compo)
            @include('compo_offers.compo')
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
@endsection
