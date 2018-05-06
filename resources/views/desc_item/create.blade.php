@extends('layouts.app')
@section('header')
    <h2> <a href="/items/admin">Items</a></h2>
@endsection
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    @if($count > 0)
        <form method="post" action="/desitem/create" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                </div>
                @foreach($descriptions as $description)
                    <div class="checkbox checkbox-success">
                        <input name="extra_id[]" id="extra_id{{ $description->id }}" type="checkbox"
                               value="{{ $description->id }}">
                        <label for="extra_id{{ $description->id }}">{{ json_decode($description->name, true)['EN'] }} {{ json_decode($description->name, true)['AR'] }}</label>
                    </div>
                @endforeach
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">Publish</button>
        </form>
    @endif
@endsection
