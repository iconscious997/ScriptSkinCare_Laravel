@extends('supplier.suppliermaster')
@section('content')
<style type="text/css">

</style>
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 9: Cost & Visiblity</h3>
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
							<h4 class="font16 bold-600 p-b-10">Cost & Visiblity</h4>
							<h4 class="font16 bold-600 block70">
								Please enter the cost of your products
							</h4>
							<div class="row ">
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Wholesafe:" value="">
										<div class="input-group-btn">
											<button class="btn btn-default h-34 customslt" type="submit">
												$
											</button>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="RRP::" value="">
										<div class="input-group-btn">
											<button class="btn btn-default h-34 customslt" type="submit">
												$
											</button>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<p class="font11">The system will take the RRP and when clinic/reatilers etc tick the products for inclusion in their client outputs,the system will automatically rank all the included products from least expansive to most per category (e.g moisturiser) and then section into thirds.The bottom third will become the budget selection,the middle third the mid range,and the top the splurge.Each companies price divide will differ depending  on the average price of their products.</p>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600 p-b-10">Product Visiblity</h4>

							<h4 class="font16 bold-600 block70">
								Please indicate where your product will be visible for the <br>consumer.
							</h4>
							<div class="row ">
								<div class="col-md-12  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Products recommendation page (after talking the test online)
										</label>
									</div>
								</div>
								<div class="col-md-12  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Retailer portal when test is taken in clinic(client is registered through the retailer portal) or when product is sold by the clinc using -Product lindertool + Manual Presciptions
										</label>
									</div>
								</div>
								<div class="col-md-12  p-0">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="">
											<span class="cr"><i class="cr-icon ti-check"></i></span>
											Cruelty free
										</label>
									</div>
								</div>
								<div class="col-md-12  p-0">
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