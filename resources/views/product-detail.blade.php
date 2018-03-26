@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="thumbnail">
                      <img src="{{$product->image()}}" alt="{{$product->slug}}">
                      <div class="caption">
                        <h3>{{$product->name}}</h3>
                        <p>{!! $product->description !!}</p>
                        <p><a href="#" class="btn btn-primary" role="button"><i class="fa fa-money"></i> Buy Product</a> <a href="{{route('add-to-cart',['slug'=>$product->slug])}}" class="btn btn-default" role="button"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
