@extends('layouts.app')
@section('header')
    <h2> <a href="/items/admin">Items</a></h2>
@endsection
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    <form method="post" action="/subitems/create" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-group">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
            </div>
            @foreach($extras as $extra)
                <div class="checkbox checkbox-success">
                    <input name="extra_id[]" id="extra_id{{ $extra->id }}" type="checkbox" value="{{ $extra->id }}">
                    <label for="extra_id{{ $extra->id }}"> {{ json_decode($extra->name, true)['EN'] }} {{ json_decode($extra->name, true)['AR'] }}</label>
                </div>
            @endforeach
        </div>
        {{ csrf_field() }}

        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection