@extends('layouts.app')

@section('header')
    <h2>Users</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">

            <form method="post" action="/user/edit/{{$user->id}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                    </div>

                    <div class="form-group">
                        <label>English Name </label>
                        <input type="text" class="form-control" name="nameEN" id="nameEN"
                               value="{{ json_decode($user->name, true)['EN'] }}">
                        @if ($errors->has('nameEN'))
                            <span class="help-block">
                    <strong>{{ $errors->first('nameEN') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Arabic Name </label>
                        <input type="text" class="form-control" name="nameAR" id="nameAR"
                               value="{{ json_decode($user->name, true)['AR'] }} ">
                        @if ($errors->has('nameAR'))
                            <span class="help-block">
                    <strong>{{ $errors->first('nameAR') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>E-Mail : </label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="type_id" class="form-control" style="height:36px">
                            <option value="{{$userType->id}}">{{$userType->Type}}</option>
                            <option value=2>Cashier</option>
                            <option value=3>Waiter</option>
                            <option value=4>Table</option>
                            @if ($errors->has('type_id'))
                                <span class="help-block">
                        <strong>{{ $errors->first('type_id') }}</strong>
                    </span>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
