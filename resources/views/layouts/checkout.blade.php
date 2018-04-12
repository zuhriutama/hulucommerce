@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="get" action="{{route('checkout-'.$step)}}">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-shopping-cart"></i> Shopping Cart
                </div>
                <div class="panel-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <div class="row">
                    <div class="col-md-7">
                      @yield('checkout')
                    </div>
                    <div class="col-md-5">
                      <h4>Order List</h4>
                      @foreach($order->orderDetails as $detail)
                      <div class="row">
                        <div class="col-md-4">
                          <a href="{{route('product-detail', ['slug'=>$detail->product->slug])}}">
                            <img class="img-responsive" src="{{$detail->product->thumbnail()}}" alt="{{$detail->product_name}}">
                        	</a>
                        </div>
                        <div class="col-md-8">
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
                	<button type="submit" class="btn btn-warning">Proceed to {{$step}}</button>
                	<strong class="pull-right">Rp. {{number_format($order->grand_total(),2,',','.')}}</strong>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
@yield('modal')
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
