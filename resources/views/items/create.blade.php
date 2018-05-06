@extends('layouts.app')
@section('header')
    <h2><a href="/items/admin">Items</a></h2>
@endsection
@section('content')

    @if(count($categories)>0)

    {{ Form::open(array('url' => '/items/create', 'files' => true )) }}
    {{ csrf_field() }}

    <div class="col-md-6">

        <div class="form-group">

            {{ Form::label('nameAR', 'Name AR', ['class' => 'awesome']) }}
            {!! Form::text('nameAR', null, ['class'=>'form-control']) !!}

            @if ($errors->has('nameAR'))
                <span class="help-block">
        <strong>{{ $errors->first('nameAR') }}</strong>
        </span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('nameEN', 'Name EN', ['class' => 'awesome']) }}
            {!! Form::text('nameEN', null, ['class'=>'form-control']) !!}
            @if ($errors->has('nameEN'))
                <span class="help-block">
        <strong>{{ $errors->first('nameEN') }}</strong>
        </span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Price', ['class' => 'awesome']) }}
            {!! Form::number('price', null, ['class' => 'form-control','step' => '0.1']) !!}
            @if ($errors->has('price'))
                <span class="help-block">
        <strong>{{ $errors->first('price') }}</strong>
        </span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('about', 'About', ['class' => 'awesome']) }}
            {!! Form::text('about', null, ['class' => 'form-control','step' => '0.1']) !!}
            @if ($errors->has('about'))
                <span class="help-block">
        <strong>{{ $errors->first('about') }}</strong>
        </span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('category', 'Category', ['class' => 'awesome']) }}

            <select name="cate_id" class="form-control" style="height:36px">
                <option>Select</option>
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

            {{ Form::label('img', 'Image', ['class' => 'awesome']) }}
            {{ Form::file('img', null)  }}
            {{--<input id="file-upload" type="file" name="img" id="img"/>--}}
            @if ($errors->has('img'))
                <span class="help-block">
        <strong>{{ $errors->first('img') }}</strong>
        </span>
            @endif
        </div>

    </div>
    <div class="col-md-6">
        <h3>Description</h3>
        <div class="form-group">

            @foreach($descriptions as $description)
                <div class="checkbox checkbox-success">
                    <input name="desc_id[]" id="desc_id{{ $description->id }}" type="checkbox"
                           value="{{ $description->id }}">
                    <label for="desc_id{{ $description->id }}">{{ json_decode($description->name, true)['EN'] }} {{ json_decode($description->name, true)['AR'] }}</label>
                </div>
            @endforeach
        </div>

    </div>
    {{ Form::submit('Publish',['class'=> 'btn btn-default']) }}
    {{ Form::close() }}
    @else
        <div class="row">
            <div class="col-md-8">
                <h2> Please Create Category </h2>
            </div>
            <div class="col-md-4">
                <a class="btn btn-primary btn-block" type="button" href="/category/create"> New Categories</a>
            </div>
        </div>
    @endif
@endsection