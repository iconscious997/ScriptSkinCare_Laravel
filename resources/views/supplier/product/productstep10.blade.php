@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 10: Activation</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 ">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Approval</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-11">
					<div >
						<h4 class="font16 bold-600">
							Please click "Yes" below to add your product to the SCRIPT database:
						</h4>
						<p class="font11">I verify that the information entered regarding this products is as true and accurate as possible.</p>
						<p class="font11">I understand that SCRIPT Pty.Ltd. will not take responsiblity for any adverse reaction caused by the use of this products.Click "Yes" to continue "No" to make changes to your products entry."Cancel" to delete your product entry.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-12">
							<h4 class="font16 bold-600">Ingredients that may cause  irration or concern :</h4>
							<div class="row ">
								<div class="col-md-3  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="" checked="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Yes
										</label>
									</div>
								</div>
								<div class="col-md-3 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											No
										</label>
									</div>
								</div>
								<div class="col-md-3 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Cancel
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