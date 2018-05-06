@extends('layouts.app')
@section('content')
    @if($count >= 0)
        @include('flash::message')
    @endif
    @if($count > 0)
        <form method="post" action="/cateExtra/create" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <input type="hidden" name="extra_id" value="{{ $extra->id }}">
                </div>
                @foreach($categories as $category)
                    <div class="checkbox checkbox-success">
                        <input name="cate_id[]" id="cate_id{{ $category->id }}" type="checkbox"
                               value="{{ $category->id }}">
                        <label for="cate_id{{ $category->id }}">{{ json_decode($category->name, true)['EN'] }}{{ json_decode($category->name, true)['AR'] }}</label>
                    </div>
                @endforeach
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-default">Publish</button>
        </form>
    @endif
@endsection