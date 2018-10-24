@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 1: Product Details</h3>
			</div>
		</div>
	</div>

	<div class="content-fix">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Please provide the following product details</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<div class="input-group">
								<select title="" class="" id="" name="">
									<option value="" disabled selected>Please select your brand</option>
								</select>
								<div class="input-group-btn">
									<button class="btn btn-dark h-34" type="submit">
										ADD NEW
									</button>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Please enter your product line:" value="">
								<div class="input-group-btn">
									<button class="btn btn-dark h-34" type="submit">
										ADD NEW
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="" id="" placeholder="Please enter your product name:" value="">
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="" id="" placeholder="Please enter your product code:" value="">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="" id="" placeholder="Please enter your product size:" value="">
							<div class="btn-search">
								ml/Oz
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="upload-btn-wrapper">
								<button class="form-control text-left">Upload image: (Up to 300px by 300px in Jpeg < 2MB)</button>
								<div class="inner-addon right-addon">
									<i class="ti-plus"></i>
									<input type="file" name="" id="" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<textarea class="form-control" rows="3" placeholder="please enter your product "></textarea>
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="" id="" placeholder="Password:" value="">
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