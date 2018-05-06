@extends('layouts.app')
@section('header')
    <h2> <a href="/offers/admin">Offers</a></h2>
@endsection
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    @if($count > 0)
        <form method="post" action="/extraoffer/create" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                </div>
                @foreach($extras as $extra)
                    <div class="checkbox checkbox-success">
                        <input name="extra_id[]" id="extra_id{{ $extra->id }}" type="checkbox"
                               value="{{ $extra->id }}">
                        <label for="extra_id{{ $extra->id }}">{{ json_decode($extra->name, true)['EN'] }} {{ json_decode($extra->name, true)['AR'] }}</label>
                    </div>
                @endforeach
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">Publish</button>
        </form>
    @endif
@endsection
