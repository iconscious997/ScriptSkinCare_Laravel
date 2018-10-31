@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 3: Gender & Age Group</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Please define the suitable demographic profile for your product:</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600">Please select which gender<br> your product is designed for :</h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Female
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Male
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600">Do you recommend this Product for <br>use whilst pregnent or breast feeding ? </h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Yes
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											No
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600">Please select which age group your<br> product is targeted at :</h4>
							<div class="row ">
								<div class="col-md-4  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Teens
										</label>
									</div>
								</div>
								<div class="col-md-4 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Adults
										</label>
									</div>
								</div>
								<div class="col-md-4 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											All
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600">Disclaimer:</h4>
							<p class="font11">Please Click 'Yes' to confirm that your company recommends this Products for use during pregnancy and whilst breast feeding. SCRIPT Pty.Ltd. will not take responsiblity for any adverse reactions caused by the recommendation and subsequent use of this product.</p>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Yes
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

<div class="footer spfooter">
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