@extends('layouts.app')
@section('header')
    <h2>Users</h2>
@endsection

@section('content')
    <form method="post" action="/user/create" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div  class="form-group">
            <label>Name AR</label>
            <input type="text" name="nameAR" class="form-control" id="name">
            @if ($errors->has('nameAR'))
                <span class="help-block">
                   <strong>{{ $errors->first('nameAR') }}</strong>
               </span>
            @endif
        </div>
        <div  class="form-group">
            <label>Name EN</label>
            <input type="text" name="nameEN" class="form-control" id="name">
            @if ($errors->has('nameEN'))
                <span class="help-block">
                   <strong>{{ $errors->first('nameEN') }}</strong>
               </span>
            @endif
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="type_id" class="form-control" style="height:36px">
                <option>Select</option>
                <option value="2">Cashier</option>
                <option value="3">Waiter</option>
                <option value="4">Table</option>
                @if ($errors->has('type_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type_id') }}</strong>
                    </span>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>E-Mail</label>
            <input type="email" class="form-control" name="email" id="email"/>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="password" class="form-control" name="password" id="password"/>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-default">Publish</button>
    </form>
@endsection
