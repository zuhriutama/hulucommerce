@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-shopping-cart"></i> Shopping Cart</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h4>Payment Address</h4>
                      @if($order->paymentAddress)
                      <p>{{$order->paymentAddress->name}}</p>
                      @else
                      <p><a href="#" data-toggle="modal" data-target="#addressModal">select payment address</a></p>
                      @endif
                      <hr>
                      <h4>Billing Address</h4>
                      @if($order->shippingAddress)
                      <p>{{$order->shippingAddress->name}}</p>
                      @else
                      <p><a href="#" data-toggle="modal" data-target="#addressModal">select shipping address</a> or <a href="#">same as payment address</a></p>
                      @endif
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <h4>Order List</h4>
                      @foreach($order->orderDetails as $detail)
                      <div class="media">
                        <div class="media-left">
                          <a href="{{route('product-detail', ['slug'=>$detail->product->slug])}}">
                            <img class="media-object" src="{{$detail->product->thumbnail()}}" alt="{{$detail->product_name}}">
                        	</a>
                        </div>
                        <div class="media-body">
                        	<h4 class="media-heading">{{$detail->product_name}}</h4>
                          {{$detail->qty}}
                          <span class="pull-right">Rp. {{number_format($detail->product_price,2,',','.')}}</span>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                	<button class="btn btn-warning">Proceed to Shipping</button>
                	<strong class="pull-right">Rp. {{number_format($order->grand_total(),2,',','.')}}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Address List</h4>
      </div>
      <div class="modal-body">
        @foreach(Auth::user()->userAddresses as $address)

        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAddress" data-dismiss="modal">New Address</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="newAddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Address</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="address">Province</label>
            <select name="province_id" id="province_id" class="form-control">
              <option></option>
              @foreach($provinces as $province)
              <option value="{{$province->id}}">{{$province->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="address">City</label>
            <select name="city_id" id="city_id" class="form-control">
              <option></option>
            </select>
          </div>
          <div class="form-group">
            <label for="zipcode">Zip Code</label>
            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
        </form>
</div>
@endsection
