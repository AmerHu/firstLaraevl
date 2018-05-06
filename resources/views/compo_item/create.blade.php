@extends('layouts.app')
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    @if($count > 0)
        <form method="post" action="/compoitem/create" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <input type="hidden" name="offer_id" value="{{ $compo->id }}">
                </div>
                @foreach($items as $item)
                    <div class="checkbox checkbox-success">
                        <input name="item_id[]" id="item_id{{ $item->id }}" type="checkbox"
                               value="{{ $item->id }}">
                        <label for="item_id{{ $item->id }}">{{ json_decode($item->name, true)['EN'] }}{{ json_decode($item->name, true)['AR'] }}</label>
                    </div>
                @endforeach
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">Publish</button>
        </form>
    @endif
@endsection