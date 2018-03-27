@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-shopping-cart"></i> Shopping Cart</div>
                <div class="panel-body">
                    @foreach($cart->cartDetails as $detail)
                    <div class="media">
                      <div class="media-left">
                        <a href="{{route('product-detail', ['slug'=>$detail->product->slug])}}">
                          <img class="media-object" src="{{$detail->product->thumbnail()}}" alt="{{$detail->product_name}}">
                      	</a>
                      </div>
                      <div class="media-body">
                      	<h4 class="media-heading">{{$detail->product_name}} <a href="{{route('remove-from-cart',['id'=>$detail->id])}}"><i class="fa fa-times"></i></a></h4>
                        {{$detail->qty}} @ Rp. {{number_format($detail->product_price,2,',','.')}}
                        <span class="pull-right">Rp. {{number_format($detail->subtotal(),2,',','.')}}</span>
                      </div>
                    </div>
                    @endforeach
                </div>
                <div class="panel-footer">
                	<button class="btn btn-warning">Checkout</button>
                	<strong class="pull-right">Rp. {{number_format($cart->total(),2,',','.')}}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
