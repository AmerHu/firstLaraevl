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
    @if(count($categories)>0)
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
        <div class="col-md-6">
            <h2> Add this Extra to Category</h2>
            <br>
            @foreach($categories as $category)
                {{ Form::checkbox('category_id[]', $category->id) }}
                {{ Form::label('category_id[]', json_decode($category->name, true)['EN']) }}
                <br/>
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
