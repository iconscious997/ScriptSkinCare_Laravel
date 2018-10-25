@extends('supplier.suppliermaster')
@section('content')
<style type="text/css">

</style>
<form action="" method="POST" id="first">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 7: Skin Types & Marketing</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<h4 class="font16 bold-600 p-b-10">Skin Types</h4>
							<h4 class="font16 bold-600 block70">
								Please select a different number for each skin type.<br>
								Number1	your product is most appropriate for.<br>
								Number4 your products is least appropriate for
							</h4>
							<div class="row ">
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" name="" id="" placeholder="Oliy" value="">
										<div class="input-group-btn">
											<select title="" class="customslt" id="" name="">
												<option value="" disabled selected>1</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" name="" id="" placeholder="Dry" value="">
										<div class="input-group-btn">
											<select title="" class="customslt" id="" name="">
												<option value="" disabled selected>1</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" name="" id="" placeholder="Combination" value="">
										<div class="input-group-btn">
											<select title="" class="customslt" id="" name="">
												<option value="" disabled selected>1</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<div class="input-group">
										<input type="text" class="form-control" name="" id="" placeholder="Normal" value="">
										<div class="input-group-btn">
											<select title="" class="customslt" id="" name="">
												<option value="" disabled selected>1</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">	
							<h4 class="font16 bold-600 p-b-10">Marketing Message</h4>

							<h4 class="font16 bold-600 block70">
								Please type in your products key selling <br>message or products blurb.
							</h4>
							<div class="row ">
								<div class="col-md-12">
									<textarea class="form-control" rows="10" placeholder="You can place content based on your needs 100 characters for Main Message that will appear product page.The rest  of the message,will be viewed by customers in the view details section"></textarea>
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