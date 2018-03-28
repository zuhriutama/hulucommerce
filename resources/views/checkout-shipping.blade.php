@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="{{route('checkout-payment')}}">
            {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-shopping-cart"></i> Shopping Cart
                  <a href="#" class="pull-right" data-toggle="modal" data-target="#newAddress">add new address</a>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-7">
                      <h4>Shipping Method</h4>
                      @foreach($shippingMethods as $shippingMethod)
                      <div class="row">
                        <div class="col-md-1">
                          <input type="radio" name="shipping_id" value="{{$shippingMethod->id}}">
                        </div>
                        <div class="col-md-2">
                          <img class="img-responsive" src="{{asset($shippingMethod->image)}}" alt="{{$shippingMethod->name}}">
                        </div>
                        <div class="col-md-9">
                          <strong>{{$shippingMethod->name}}</strong>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <div class="col-md-5">
                      <h4>Order List</h4>
                      @foreach($order->orderDetails as $detail)
                      <div class="media">
                        <div class="media-left">
                          <a href="{{route('product-detail', ['slug'=>$detail->product->slug])}}">
                            <img class="media-object" src="{{$detail->product->thumbnail()}}" alt="{{$detail->product_name}}">
                        	</a>
                        </div>
                        <div class="media-body">
                        	<strong>{{$detail->product_name}}</strong><br>
                          {{$detail->qty}}
                          <span class="pull-right">@ Rp. {{number_format($detail->product_price,2,',','.')}}</span>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                	<button type="submit" class="btn btn-warning">Proceed to Payment</button>
                	<strong class="pull-right">Rp. {{number_format($order->grand_total(),2,',','.')}}</strong>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection