@extends('layouts.checkout')

@section('checkout')
<h4>Payment Method</h4>
@foreach($paymentMethods as $paymentMethod)
<div class="row">
  <div class="col-md-1">
    <input type="radio" name="payment_id" value="{{$paymentMethod->id}}">
  </div>
  <div class="col-md-2">
    <img class="img-responsive" src="{{asset($paymentMethod->image)}}" alt="{{$paymentMethod->name}}">
  </div>
  <div class="col-md-9">
    <strong>{{$paymentMethod->name}}</strong>
  </div>
</div>
@endforeach
@endsection