@extends('layouts.app')
@section('header')
    <h2><a href="/offers/admin">Offers</a></h2>
@endsection




@section('content')

    {{ Form::open(array('url' => '/offers/create', 'files' => true )) }}
    {{ csrf_field() }}
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
        {{ Form::label('price', 'Price', ['class' => 'awesome']) }}
        {!! Form::number('price', null, ['class' => 'form-control','step' => '0.1']) !!}
        @if ($errors->has('price'))
            <span class="help-block">
        <strong>{{ $errors->first('price') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <label>Is Offers</label>
        <br>
        <label> Required </label>
        <input name="require" id="require" type="radio" value="1"><br/>
        <label>Not Required </label>
        <input checked="checked" id="require" name="require" type="radio" value="0">
    </div>
    <div class="form-group">
        <label>Is Active</label>
        <br>
        <label> Active </label>
        <input name="active" id="active" type="radio" value="1"><br/>
        <label>Not Active </label>
        <input checked="checked" id="active" name="active" type="radio" value="0">
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


    {{ Form::submit('Publish',['class'=> 'btn btn-default']) }}
    {{ Form::close() }}


@endsection
