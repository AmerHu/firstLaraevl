@extends('layouts.app')

@section('header')
    <h2> <a href="/category/admin">Categories</a></h2>
@endsection

@section('content')

    {{ Form::open(array('url' => '/category/create', 'files' => true )) }}
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
