@extends('layouts.master')
@section('content')

<form action="{{ url('/retailsitestore') }}" method="POST" id="first">
	@csrf

	<div class="wizard">
		<div class="container">
			<div class="row">
				<h3 class="text-center">SET-UP NEW RETAIL</h3>
			</div>
		</div>
	</div>

	<div class="content-fix wow fadeIn" data-wow-duration="2s" >
		<div class="container">
			<div class="row">
				<div class="col-md-3">&nbsp;</div>
				<div class="col-md-6">
					<div class="clearfix">&nbsp;</div>
					<h4 class="bold-700 font17 mb-5">Please Enter Retail Site:</h4>
					<div class="clearfix">&nbsp;</div>
					<div class="form-group">
						@if ( !empty($retailsite) )
						<input type="hidden" name="id" value="{{ $retailsite->id }}">
						@endif
						<input type="text" class="form-control" name="clinic_name" id="clinic_name" placeholder="Registered Business Name:" value="{{ !empty($retailsite->clinic_name) ? $retailsite->clinic_name : old('clinic_name') }}">
						@if ($errors->has('clinic_name'))
						<span class="inputError">{{ $errors->first('clinic_name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:" value="{{ !empty($retailsite->trading_name) ? $retailsite->trading_name : old('trading_name') }}">
						@if ($errors->has('trading_name'))
						<span class="inputError">{{ $errors->first('trading_name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="clinic_location" id="clinic_location" placeholder="Clinic Location:" value="{{ !empty($retailsite->clinic_location) ? $retailsite->clinic_location : old('clinic_location') }}">
						@if ($errors->has('clinic_location'))
						<span class="inputError">{{ $errors->first('clinic_location') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="telephone_number" id="telephone_number" placeholder="Telephone Number:" value="{{ !empty($retailsite->telephone_number) ? $retailsite->telephone_number : old('telephone_number') }}" onkeypress="return isNumberKey(event)">
						@if ($errors->has('telephone_number'))
						<span class="inputError">{{ $errors->first('telephone_number') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="clinic_email" id="clinic_email" placeholder="Email Address:" value="{{ !empty($retailsite->clinic_email) ? $retailsite->clinic_email : old('clinic_email') }}">
						@if ($errors->has('clinic_email'))
						<span class="inputError">{{ $errors->first('clinic_email') }}</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="clinic_website" id="clinic_website" placeholder="Clinic Website:" value="{{ !empty($retailsite->clinic_website) ? $retailsite->clinic_website : old('clinic_website') }}">
						@if ($errors->has('clinic_website'))
						<span class="inputError">{{ $errors->first('clinic_website') }}</span>
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
					<button class="btn btn-dark btn-pad" type="button" onclick="javascript:$('#first').submit();">  Save Changes </button>
				</div>
				<div class="col-md-2">&nbsp;</div>
			</div>
		</div>
	</div>

</form>

<div class="footer">

	<div class=" text-center">
		<div class="">
			<div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
				<a href="{{ url('/new-retail') }}" ><button type="button" class="btn btn-default ripple spbtn"> + ADD NEW RETAIL</button></a>

				<a href="{{ url('/new-retail-user') }}" > <button type="button" class="btn btn-default ripple spbtn m-l-20"> + ADD A NEW USER</button></a>

			</div>
			<div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
		</div>
	</div>
</div>
@endsection