@extends('layouts.checkout')

@section('checkout')
<h4>Payment Address</h4>
<input type="hidden" name="payment_address" value="{{$order->payment_address_id}}">
@if($order->paymentAddress)
  <p>{{$order->paymentAddress->name}} ({{$order->paymentAddress->phone}})</p>
  <p>{{$order->paymentAddress->address}}</p>
@endif
<p><a href="#" data-toggle="modal" data-target="#paymentAddressModal">{{$order->paymentAddress?'change':'select'}} payment address</a></p>
<hr>
<h4>Shipping Address</h4>
<input type="hidden" name="shipping_address" value="{{$order->shipping_address_id}}">
@if($order->shippingAddress)
  <p>{{$order->shippingAddress->name}} ({{$order->shippingAddress->phone}})</p>
  <p>{{$order->shippingAddress->address}}</p>
@endif
<p><a href="#" data-toggle="modal" data-target="#shippingAddressModal">{{$order->shippingAddress?'change':'select'}} shipping address</a></p>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="paymentAddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Address List</h4>
      </div>
      <div class="modal-body">
        @foreach(Auth::user()->userAddresses as $address)
        <p><a href="#" class="address" data-id="{{$address->id}}" data-type="payment">{{$address->name}}</a> ({{$address->phone}})</p>
        <p>{{$address->address}}</p>
        <hr>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAddress" data-dismiss="modal">New Address</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="shippingAddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Address List</h4>
      </div>
      <div class="modal-body">
        @foreach(Auth::user()->userAddresses as $address)
        <p><a href="#" class="address" data-id="{{$address->id}}" data-type="shipping">{{$address->name}}</a> ({{$address->phone}})</p>
        <p>{{$address->address}}</p>
        <hr>
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
  <form method="post" action="{{route('add-address')}}">
    {{csrf_field()}}
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

@section('script')
<script type="text/javascript">
  $('select[name=province_id]').change(function(e){
    let data = {
      province_id : $(this).val(),
    }
    $.get("{{route('get-city-of-province')}}", data, function(res) {
        $('select[name=city_id]').html('')
        res.forEach(function (city){
            $('select[name="city_id"]').append('<option value="'+city.id+'">'+city.name+'</option>')
        })
    }).fail(function(xhr, status, error) {
        swal('Error!', 'Data not found!', 'error')
    })
  })

  $('.address').click(function(e){
    e.preventDefault()

    ctrl = $(this);

    let data = {
      _token: '{{csrf_token()}}',
      order_id : {{$order->id}},
      type: ctrl.data('type'),
      address_id: ctrl.data('id'),
    }
    $.post("{{route('set-address-for-order')}}", data, function(res) {
        location.reload()
    }).fail(function(xhr, status, error) {
        swal('Error!', 'Failed set address!', 'error')
    })
  })
</script>
@endsection
