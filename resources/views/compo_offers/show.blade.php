@extends('layouts.app')
@section('header')
    <h2> <a href="/compo/admin">Compo Offers</a></h2>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-6">
            <h3>English Name : {{ json_decode($compo->name, true)['EN'] }}</h3><br/>
            <h3>Arabic Name : {{ json_decode($compo->name, true)['AR'] }}</h3><br/>
            <h3>Price : {{ $compo->price}}</h3>
            <hr/>
            @if(count($items)>0)
                <h2> Compos Items</h2>
            <br/>
                @foreach($items as $item)
                    <div class="row">
                        <div class="col-md-11">
                            <h4>  {{ json_decode($item->name, true)['EN'] }}{{ json_decode($item->name, true)['AR'] }}</h4>
                        </div>
                        <div class="col-md-1">
                            <a href="/compoitem/delete/{{$item->id}}/{{ $compo->id}}"
                               class="btn btn-danger" type="button"
                               onclick="return confirm('Are you sure you want to delete this items Offer?')">X</a>
                        </div>
                    </div>
                    <br/>
                @endforeach
                <hr/>
            @endif
           <div class="row"></div>
           <div class="row">
               <div class="col-md-6">
                   <a class="btn btn-primary btn-block" type="button" href="/compo/edit/{{$compo->id}}">edit</a>
               </div>
               <div class="col-md-6">
                   <a class="btn btn-primary btn-block" type="button" href="/compoitem/create/{{$compo->id}}">Add new Compo Offers</a>
               </div>
           </div>
        </div>
        <div class="col-md-6">
            <img src="/{{ $compo->img }}" width="100%"/>
        </div>
    </div>
@endsection
