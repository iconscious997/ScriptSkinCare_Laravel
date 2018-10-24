@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 4: Body Areas & Time of Day</h3>
			</div>
		</div>
	</div>

	<div class="content-fix">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600 p-b-10">Basic Skincare</h4>
							<h4 class="font16 bold-600">On what area of the body would this <br>product most commonly be used?
								<p class="font11">(Can select more than one)</p>
							</h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Face
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Eyes
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Lips
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Body
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600 p-b-10">Time of Day</h4>

							<h4 class="font16 bold-600">Please select which time of day<br> the product should be used ? </h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											In the morning 
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											In the evening
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Both morning & evening
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label  class="nowrap">
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Sporadcally (e.g Weekly/Monthly)
										</label>
									</div>
								</div>
							</div>
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