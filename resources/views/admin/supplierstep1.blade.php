@extends('layouts.master')
@section('content')

<form action="{{ url('/supplierstep1store') }}" method="POST" id="first">
	@csrf

	<div class="wizard">
		<div class="container">
			<div class="row">
				<h3 class="text-center">STEP 1: COMPANY DETAILS*</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s" >
		<div class="container">
			<div class="row">
				<div class="col-md-3">&nbsp;</div>
				<div class="col-md-6">
					<div class="clearfix">&nbsp;</div>
					<h4 class="bold-700 font17 mb-5">Please Enter New Company Details:</h4>
					<div class="clearfix">&nbsp;</div>
					<div class="form-group">
						<input type="hidden" name="savestep" id="savestep" value="0">
						
						@if ( !empty($company) )
						<input type="hidden" name="id" value="{{ $company->id }}">						
						@endif
						<input type="text" class="form-control" name="registered_business_name" id="registered_business_name" placeholder="Registered Business Name:" value="{{ !empty($company->business_name) ? $company->business_name : old('registered_business_name') }}">
						@if ($errors->has('registered_business_name'))
						<span class="inputError">{{ $errors->first('registered_business_name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:" value="{{ !empty($company->trading_name) ? $company->trading_name : old('trading_name') }}">
						@if ($errors->has('trading_name'))
						<span class="inputError">{{ $errors->first('trading_name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="abn" id="abn" placeholder="ABN:" value="{{ !empty($company->abn) ? $company->abn : old('abn') }}">
						@if ($errors->has('abn'))
						<span class="inputError">{{ $errors->first('abn') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="address" id="address" placeholder="Address:" value="{{ !empty($company->address) ? $company->address : old('address') }}">
						@if ($errors->has('address'))
						<span class="inputError">{{ $errors->first('address') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="business_telephone" id="business_telephone" placeholder="Business Telephone:" value="{{ !empty($company->business_telephone_number) ? $company->business_telephone_number : old('business_telephone') }}" onkeypress="return isNumberKey(event)">
						@if ($errors->has('business_telephone'))
						<span class="inputError">{{ $errors->first('business_telephone') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="email_address" id="email_address" placeholder="Email Address:" value="{{ !empty($company->email_address) ? $company->email_address : old('email_address') }}">
						@if ($errors->has('email_address'))
						<span class="inputError">{{ $errors->first('email_address') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="website" id="website" placeholder="Website:" value="{{ !empty($company->website) ? $company->website : old('website') }}">
						@if ($errors->has('website'))
						<span class="inputError">{{ $errors->first('website') }}</span>
						@endif
					</div>
				</div>
				<div class="col-md-3">&nbsp;</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-md-2">&nbsp;</div>
				<div class="col-md-8 text-center">
					<hr>
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15"></div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<ul class="pagination pagination-split">
								<li class="page-item active"><span class="page-link">1</span></li>
								<li class="page-item"><span class="page-link">2</span></li>
								<li class="page-item"><span class="page-link">3</span></li>
								<li class="page-item"><span class="page-link">4</span></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  mt-15 text-right">
							<a onclick="javascript:$('#first').submit();" class="next" id="nextBtn">
								NEXT &nbsp;<i class="ti-arrow-right"></i>
							</a>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-2">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-offset-2 col-md-8 text-center mt-30 mb-20">
					<button class="btn btn-dark btn-pad" type="button" id="btnsavestep"> SAVE STEP 1</button>
				</div>
				<div class="col-md-2">&nbsp;</div>
			</div>
		</div>
	</div>

</form>

<div class="footer">
	<div class="text-center">
		<div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			<a href="{{ url('/supplier-company-add') }}" ><button type="button" class="btn btn-default ripple spbtn"> + ADD NEW SUPPLIER</button></a>

			<a href="{{ url('/add-new-user') }}" > <button type="button" class="btn btn-default ripple spbtn m-l-20"> + ADD A NEW USER</button></a>

			<a href="{{ url('/add-new-brand') }}"><button type="button" class="btn btn-default ripple spbtn m-l-20"> + ADD A NEW BRAND</button></a>

		</div>
		<div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#btnsavestep').on('click', function(e) {

        // set the savestep to 1 so we can track that we have to redirect to next or not
        $('#savestep').val(1);
        $('#first').submit();
    });
	});
</script>
@endsection