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
    <h2><a href="/extra/admin">Extra Items</a></h2>
@endsection

@section('content')

        {{ Form::open(array('url' => '/extra/create', 'files' => true )) }}
    <div class="row">
        <div class="col-md-6">  {{ csrf_field() }}
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
        </div>

    </div>
    {{ Form::submit('Publish',['class'=> 'btn btn-default']) }}
    {{ Form::close() }}

@endsection
