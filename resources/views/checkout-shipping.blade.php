@extends('layouts.checkout')

@section('checkout')
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
@endsection