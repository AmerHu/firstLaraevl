@extends('layouts.app')
@section('header')
    <h2> <a href="/items/admin">Items</a></h2>
@endsection
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    <form method="post" action="/default/create" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
            </div>
            @foreach($defaults as $default)
                <div class="checkbox checkbox-success">
                    <input name="default_id[]" id="default_id{{ $default->id }}" type="checkbox" value="{{ $default->id }}">
                    <label for="default_id{{ $default->id }}"> {{ json_decode($default->name, true)['EN'] }} {{ json_decode($default->name, true)['AR'] }}</label>
                </div>
            @endforeach
        </div>
        {{ csrf_field() }}

        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection