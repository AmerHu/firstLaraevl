@extends('layouts.app')

<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>
@section('header')
    <h2> <a href="/items/admin">Items</a></h2>
@endsection
@section('content')

    <form method="post" action="/items/edit/{{$items->id}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Arabic Name </label>
            <input type="text" class="form-control" name="nameEN" id="nameEN"
                   value="{{ json_decode($items->name, true)['AR'] }} ">
            @if ($errors->has('nameEN'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameEN') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>English Name </label>
            <input type="text" class="form-control" name="nameAR" id="nameAR"
                   value="{{ json_decode($items->name, true)['EN'] }}">
            @if ($errors->has('nameAR'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameAR') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" name="price" id="price" value= {{$items->price}}>
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="cate_id" class="form-control" style="height:36px">
                <option value="{{ $items->cate_id }}">NO Change Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ json_decode($category->name, true)['EN'] }}
                    </option>
                @endforeach
                @if ($errors->has('cate_id'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('cate_id') }}</strong>
                                    </span>
                @endif
            </select>
        </div>


        <div class="form-group">
            <label>{{ $items->img }}</label>

            <label for="file-upload" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> <Strong> Change Image</Strong>
            </label>


            <input id="file-upload" name="img" type="file" style=" display: none;"/>

            @if ($errors->has('img'))
                <span class="help-block">
                   <strong>{{ $errors->first('img') }}</strong>
               </span>
            @endif
        </div>
        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection
