@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                    @foreach($products as $product)
                    <div class="row">
                      <div class="col-md-2">
                        <a href="{{route('product-detail', ['slug'=>$product->slug])}}">
                          <img class="media-object img-responsive" src="{{$product->thumbnail()}}" alt="{{$product->slug}}">
                        </a>
                      </div>
                      <div class="col-md-10">
                        <a href="{{route('product-detail', ['slug'=>$product->slug])}}"><h4 class="media-heading">{{$product->name}}</h4></a>
                        {!! $product->short_desc !!}
                      </div>
                    </div>
                      <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
