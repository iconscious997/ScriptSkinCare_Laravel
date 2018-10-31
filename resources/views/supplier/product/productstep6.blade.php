@extends('supplier.suppliermaster')
@section('content')
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 6: Activity Level & Ingredients</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 ">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div >
						<h4 class="font16 bold-600">Level of Activity</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-7">
					<div >
						<h4 class="font16 bold-600">Is this product suitbale for people who have used cosmeceuticals before?</h4>
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
						<div class="form-group col-md-12">
							<h4 class="font16 bold-600">Active Ingredients</h4>
							<p>if your products contains active ingredients.please select All ingredients from the list below. </p>
							<div class="row ">
								<div class="col-md-2  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											AHA
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Aloe vera
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Antioxidants
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Arbutin
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label class="nowrap">
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Benzoyl peroxide
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Botanicals
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Caffeine
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Clay
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Charmomile
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label class="nowrap">
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											DNA Repair Enzyme
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Enzymes
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Essential Oil
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Folic Acid
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Growth Factor
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Glycolic Acid
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Green tea
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Hyaluronic Acid
										</label>
									</div>
								</div>
								<div class="col-md-2 p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Jajoba
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