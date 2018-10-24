@extends('supplier.suppliermaster')
@section('content')
<div class="">
	<div class="dashboard">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg2 bdright">
			<div class="">
				<div>
					<h4>Welcome {{ Auth::user()->name }}</h4>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg2 bdright">
			<div class="">
				<div>
					<h4 class="mb-10">Search</h4>
				</div>
				<div class="search">
					<div class="form-group">
						<input type="" class="form-control" name="">
						<span class="btn-search">
							<i class="ti-search"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg4 bdright">
			<div class="">
				<div>
					<h4>Recent Products Review</h4>
				</div>
				<div class="items">
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>Product 1</p> 
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>Product 2</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>  Product 3</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg4">
			<div class="">
				<div>
					<h4>Product Expiry Review</h4>
				</div>
				<div class="items">
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>Product 1</p> 
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>Product 2</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
					<div class="row mb-20">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p>  Product 3</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button class="btn btn-default pull-right"> View </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection