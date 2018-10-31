@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 2: Select Category</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Please place your product into one of the following categories:</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600">Basic Skincare</h4>
							<div class="row ">
								@foreach( $category as $cat )
								@if( $cat->step_no == 2 )
								<div class="col-md-6  p-0">
									<div class="radio">
										<label>
											<input type="radio" name="skintype" value="{{ $cat->id }}">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											{{ $cat->category_name }}
										</label>
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600">Active Skincare</h4>
							<div class="row ">
								@foreach( $category as $cat )
								@if( $cat->step_no == 21 )
								<div class="col-md-6  p-0">
									<div class="radio">
										<label>
											<input type="radio" name="skintype" value="{{ $cat->id }}">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											{{ $cat->category_name }}
										</label>
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-12">
							<p>Please select the most accurate description of your product. Select 1 per column.</p>
						</div>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>
			<div class="row mt-50 mb-20">
				@include('supplier.product.pagination')
			</div>
		</div>
	</div>

</form>

<div class="footer">
	<div class="text-center">
		<div class="col-md-3 col-sm-3 hidden-xs">&nbsp;</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="{{ route('supplierproductstep1') }}" >
						<button type="button" class="btn btn-default btn-block"> + ADD A NEW PRODUCT</button>
					</a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="javascript:void(0)" > 
						<button type="button" class="btn btn-default btn-block"> + ADD A NEW PRODUCT LINE</button>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 hidden-xs">&nbsp;</div>
	</div>
</div>
@endsection