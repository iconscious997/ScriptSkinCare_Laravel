@extends('layouts.master')
@section('content')

<form action="{{ url('/clinicinsert') }}" method="POST" id="first">
	@csrf

	<div class="wizard">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Add Retail Site</h3>
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
				<div class="col-md-offset-2 col-md-8 text-center mt-30 mb-20">
					<button class="btn btn-dark btn-pad" type="button" onclick="javascript:$('#first').submit();">  Save Changes </button>
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
			<a href="{{ url('/new-retail') }}" ><button type="button" class="btn btn-default ripple spbtn active"> + ADD NEW RETAIL</button></a>

			<a href="{{ url('/new-retail-user') }}" > <button type="button" class="btn btn-default ripple spbtn m-l-20"> + ADD A NEW USER</button></a>

			
		</div>
		<div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
	</div>
</div>
@endsection