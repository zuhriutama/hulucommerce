<li><a href="{{url('admin/products')}}"><i class="fa fa-cubes"></i> <span>Products</span></a></li>
<li><a href="javascript:doLogout()"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
<form name="logout" method="post" action="{{route('logout')}}">
	{{csrf_field()}}
</form>