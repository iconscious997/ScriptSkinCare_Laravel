@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 8: Consumer Concerns</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 ">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Consumer Concerns</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-7">
					<div >
						<h4 class="font16 bold-600">
							The following are items that may cause some consumers concern. Please indicate which applies to your products.
						</h4>
					</div>
				</div>
				<div class="col-md-4 pull-left">
					<div class="col-md-3 p-0">
						<div class="checkbox">
							<label>
								<input type="checkbox" value="">
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
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600">Ingredients that may cause  irration or concern :</h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="" checked="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Alcohol
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Frangrance
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Gluten
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Larolin
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Oil
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Parabens
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Perservaties
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											SLS(Sodium Laureate Sulfate)
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600">Ethical considersations:</h4>
							<div class="row ">
								<div class="col-md-6  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="" checked="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Cruelty
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Enviromentally friendly
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Fair Trade
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Organic
										</label>
									</div>
								</div>
								<div class="col-md-6 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Vegam
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