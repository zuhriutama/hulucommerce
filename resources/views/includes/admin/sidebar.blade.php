<li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<li><a href="{{url('admin/provinces')}}"><i class="fa fa-university"></i> <span>Provinces</span></a></li>
<li><a href="{{url('admin/cities')}}"><i class="fa fa-industry"></i> <span>Cities</span></a></li>
<li><a href="{{url('admin/payment-methods')}}"><i class="fa fa-money"></i> <span>Payment Methods</span></a></li>
<li><a href="{{url('admin/shipping-methods')}}"><i class="fa fa-truck"></i> <span>Shipping Methods</span></a></li>
<li><a href="{{url('admin/products')}}"><i class="fa fa-cubes"></i> <span>Products</span></a></li>
<li><a href="{{url('admin/users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
<li><a href="{{url('admin/user-addresses')}}"><i class="fa fa-map-marker"></i> <span>User Addresses</span></a></li>
<li><a href="javascript:doLogout()"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
<form name="logout" method="post" action="{{route('logout')}}">
	{{csrf_field()}}
</form>