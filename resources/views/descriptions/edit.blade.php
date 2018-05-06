@extends('layouts.app')
@section('header')
    <h2> <a href="/desc/admin">Description</a></h2>
@endsection



@section('content')

    <form method="post" action="/desc/edit/{{$description->id}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="id"  id="id" value = {{$description->id}}>

        <div class="form-group">
            <label>Arabic Name </label>
            <input type="text" class="form-control" name="nameEN" id="nameEN" value= "{{ json_decode($description->name, true)['AR'] }} ">
            @if ($errors->has('nameEN'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameEN') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>English Name </label>
            <input type="text" class="form-control" name="nameAR" id="nameAR" value= "{{ json_decode($description->name, true)['EN'] }}" >
            @if ($errors->has('nameAR'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameAR') }}</strong>
                </span>
            @endif
        </div>


        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection
