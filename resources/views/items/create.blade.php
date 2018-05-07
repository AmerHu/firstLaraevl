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
            {{ Form::label('cate_id', 'Category', ['class' => 'awesome']) }}

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

            {{ Form::label('desc_id', 'Description', ['class' => 'awesome']) }}
            <select name="desc_id" class="form-control" style="height:36px">
                <option>Select</option>
                @foreach($descriptions as $description)
                    <option value="{{ $description->id }}">
                        {{ json_decode($description->name, true)['EN'] }}

                    </option>
                @endforeach
                @if ($errors->has('desc_id'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('desc_id') }}</strong>
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
        <h3> Extra</h3>
        <div class="form-group">

            @foreach($extras as $extra)
                <div class="checkbox checkbox-success">
                    <input name="extra_id[]" id="extra_id{{ $extra->id }}" type="checkbox"
                           value="{{ $extra->id }}">
                    <label for="extra_id{{ $extra->id }}">{{ json_decode($extra->name, true)['EN'] }} {{ json_decode($extra->name, true)['AR'] }}</label>
                </div>
            @endforeach
        </div>
        <h3>Default Extra</h3>
        <div class="form-group">

            @foreach($defaults as $default)
                <div class="checkbox checkbox-success">
                    <input name="default_id[]" id="default_id{{ $default->id }}" type="checkbox"
                           value="{{ $default->id }}">
                    <label for="default_id{{ $default->id }}">{{ json_decode($default->name, true)['EN'] }} {{ json_decode($default->name, true)['AR'] }}</label>
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