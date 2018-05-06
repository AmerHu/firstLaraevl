@extends('layouts.app')
@section('header')
    <h2> <a href="/extra/admin">Extra Items</a></h2>
@endsection

@section('content')
    <form method="post" action="/extra/edit/{{$extra->id}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Arabic Name </label>
            <input type="text" class="form-control" name="nameEN" id="nameEN" value= "{{ json_decode($extra->name, true)['AR'] }} ">
            @if ($errors->has('nameEN'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameEN') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>English Name </label>
            <input type="text" class="form-control" name="nameAR" id="nameAR" value= "{{ json_decode($extra->name, true)['EN'] }}" >
            @if ($errors->has('nameAR'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameAR') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" name="price" id="price" value = {{$extra->price}}>
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection
