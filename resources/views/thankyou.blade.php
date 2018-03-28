@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">
                  <i class="fa fa-file"></i> Order {{$order->serial}}
                  <span class="pull-right">{{\Carbon\Carbon::parse($order->updated_at)->format('j M Y H:i')}}</span>
                </div>
                <div class="panel-body">
                	<p><strong>Customer</strong></p>
                	@if($order->user)
                    <address>
					  <strong>{{$order->user->name}}</strong><br>
					  <abbr title="Email">Email:</abbr> {{$order->user->email}}
					</address>
					@endif
                	<div class="row">
                		<div class="col-md-6">
		                	<p><strong>Payment Address</strong></p>
		                	@if($order->paymentAddress)
		                    <address>
							  <strong>{{$order->paymentAddress->name}}</strong><br>
							  {!! $order->paymentAddress->fullAddress() !!}<br>
							  <abbr title="Phone">Phone:</abbr> {{$order->paymentAddress->phone}}
							</address>
							@endif
						</div>
                		<div class="col-md-6">
		                	<p><strong>Shipping Address</strong></p>
		                	@if($order->shippingAddress)
		                    <address>
							  <strong>{{$order->shippingAddress->name}}</strong><br>
							  {!! $order->shippingAddress->fullAddress() !!}<br>
							  <abbr title="Phone">Phone:</abbr> {{$order->shippingAddress->phone}}
							</address>
						</div>
					</div>
					<br/>
                	<p><strong>Order Details</strong></p>
                	<table class="table">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Product</th>
								<th class="text-center">Qty</th>
								<th class="text-center">Price</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order->orderDetails as $detail)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$detail->product_name}}</td>
								<td class="text-center">{{$detail->qty}}</td>
								<td class="text-right">Rp. {{number_format($detail->product_price,2,',','.')}}</td>
								<td class="text-right">Rp. {{number_format($detail->subtotal(),2,',','.')}}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th colspan="2">Sub Total</th>
								<th></th>
								<th class="text-right">Rp. {{number_format($order->total_price(),2,',','.')}}</th>
							</tr>
							<tr>
								<th></th>
								<th colspan="2">Shipping Cost</th>
								<th></th>
								<th class="text-right">Rp. {{number_format($order->shipping_cost,2,',','.')}}</th>
							</tr>
							<tr>
								<th></th>
								<th colspan="2">Grand Total</th>
								<th></th>
								<th class="text-right">Rp. {{number_format($order->grand_total(),2,',','.')}}</th>
							</tr>
						</tfoot>
					</table>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
