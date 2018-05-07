@extends('layouts.app')
@section('header')
    <h2><a href="/items/admin">Items</a></h2>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-6">
            <h3>English Name : {{ json_decode($item->name, true)['EN'] }}</h3><br/>
            <h3>Price : {{ $item->price}}</h3><br/>
            <h3>Category :{{ json_decode($category, true)['EN'] }}</h3><br/>
            <h3>Description :{{ json_decode($description, true)['EN'] }}</h3>
            <hr/>
            <h2>Extra Items</h2>
            <br/>
            @foreach($extras as $extra)
                <div class="row">
                    <div class="col-md-11">
                        <h4> {{ json_decode($extra->name, true)['EN'] }} </h4>
                    </div>
                    <div class="col-md-1">
                        <a href="/subitems/delete/{{$extra->id}}/{{ $item->id}}"
                           class="btn btn-danger" type="button"
                           onclick="return confirm('Are you sure you want to delete this Extra Item?')">X</a>
                    </div>
                </div>
                <br/>
            @endforeach
            <hr/>
            <h2>Default Items Extra</h2>
            <br/>
            @foreach($defaults as $default)
                <div class="row">
                    <div class="col-md-11">
                        <h4> {{ json_decode($default->name, true)['EN'] }} </h4>
                    </div>
                    <div class="col-md-1">
                        <a href="/default/delete/{{$default->id}}/{{ $item->id}}"
                           class="btn btn-danger" type="button"
                           onclick="return confirm('Are you sure you want to delete this defaults?')">X</a>
                    </div>
                </div>
                <br/>
            @endforeach
            <hr/>

        </div>

        <div class="col-md-6">
            <img src="/{{ $item->img }}" width="100%"/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <a class="btn btn-primary btn-block" type="button" href="/items/edit/{{$item->id}}">edit</a>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-primary btn-block" type="button" href="/subitems/create/{{$item->id}}">Add new
                        Extra</a>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-primary btn-block" type="button" href="/default/create/{{$item->id}}">Add New
                        Default </a>
                </div>
            </div>
        </div>
    </div>
@endsection
