
<header>
	<div class="container">
		<div class="row Headermobile">
			<div class="col-xs-1">
				<a id="menu-toggle" type="" class="toogle">
					<i class="ti-align-left"></i>
				</a>
			</div>
			<div class="name col-xs-7">
				<h4><a href="{{ route('home') }}">Script Skincare </a></h4>
			</div>
			<div class="col-xs-4 icons">
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i> 
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>


</header>

<div id="sidebar-wrapper">

	<ul class="sidebar-nav">
		<div class="canvi-user-info">
			<a href="" class="canvi-user-info__meta" data-toggle="modal" data-target=".loginModal">
				<div class="canvi-user-info__image">
					<i class="ti-user"></i>
				</div>
				<div class="canvi-user-info__data">
					<span class="canvi-user-info__title">Welcome </span>
					<a href="#" class="canvi-user-info__meta">{{ Auth::user()->name }}</a>
					<div class="canvi-user-info__close" id="menu-close"></div>
				</div>
			</a>
		</div>
	</ul>
	<ul class="nav navmenu-nav navmenu-nav-new canvi-navigation"">
		<li>
			<a href="{{ route('supplierhome') }}"  >
				<div class="col-xs-12">
					Dashboard
				</div>
			</a>
		</li>
		<li>
			<a href="javascript:void(0)" id="btn-0" data-toggle="collapse" data-target="#submenu_0" aria-expanded="false" class="" >
				<div class="col-xs-12">
					Products
				</div>
			</a>
			<ul class="nav collapse" id="submenu_0" role="menu" aria-labelledby="btn-0">
				@can('product_list')
				<li><a href="{{ route('supplierproduct') }}" class="">Product List</a></li>
				@endcan
				@can('new_product')
				<li><a href="{{ route('supplierproductstep1') }}" class="">Add New Product</a></li>
				@endcan
				<li><a href="javascript:void(0)" class="">Manage A Products</a></li>
				@can('manage_role_permission')
				<li><a href="{{ route('supplierpermission')}}">Manage Role Permissions</a></li>
				@endcan
			</ul>
		</li>
		<li>
			<a href="javascript:void(0)" id="btn-1" data-toggle="collapse" data-target="#submenu_1" aria-expanded="false" class="" >
				<div class="col-xs-12">
					Company Details,Brands & Users
				</div>
			</a>
			<ul class="nav collapse" id="submenu_1" role="menu" aria-labelledby="btn-1">
				<li><a href="{{ route('suppliercompany') }}" class="">Company List</a></li>
				<li><a href="{{ route('suppliercompanyadd') }}" class="">Create New Company</a></li>
			</ul>
		</li>
		<li>
			<a href="#" id="btn-2" data-toggle="collapse" data-target="#submenu_2" aria-expanded="false" class="" >
				<div class="col-xs-12">
					Brands
				</div>
			</a>
			<ul class="nav collapse" id="submenu_2" role="menu" aria-labelledby="btn-2">
				<li><a href="{{ route('supplierbrand') }}">Brand List</a> </li>
				<li><a href="{{ route('supplierbrandadd') }}">Create New Brand</a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:void(0)" id="btn-3" data-toggle="collapse" data-target="#submenu_3" aria-expanded="false" class="" >
				<div class="col-xs-12">
					Products line
				</div>
			</a>
			<ul class="nav collapse" id="submenu_3" role="menu" aria-labelledby="btn-3">
				<li><a href="{{ route('supplierproductline') }}" class="">Product line List</a></li>
				<li><a href="{{ route('supplierproductlineadd') }}" class="">Create New Product line</a></li>
			</ul>
		</li>
	</ul>

</div>
