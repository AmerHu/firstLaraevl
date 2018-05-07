@extends('layouts.app')
@section('header')
    <h2><a href="/compo/admin">Compo Offers</a></h2>
@endsection

@section('content')
    {{ Form::open(array('url' => '/compo/create', 'files' => true )) }}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6"><div class="form-group">

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
           <h2> Items</h2>
            @foreach($items as $item)
                <div class="checkbox checkbox-success">
                    <input name="item_id[]" id="item_id{{ $item->id }}" type="checkbox"
                           value="{{ $item->id }}">
                    <label for="item_id{{ $item->id }}">{{ json_decode($item->name, true)['EN'] }}{{ json_decode($item->name, true)['AR'] }}</label>
                </div>
            @endforeach
        </div>
    </div>
    {{ Form::submit('Publish',['class'=> 'btn btn-default']) }}
    {{ Form::close() }}
@endsection


