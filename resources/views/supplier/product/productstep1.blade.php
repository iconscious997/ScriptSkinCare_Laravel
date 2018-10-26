@extends('supplier.suppliermaster')
@section('content')
<form action="{{ route('supplierproductstep1store') }}" method="POST" id="first" enctype="multipart/form-data">
	@csrf

	<div class="wizard bg3">
		<div class="container">
			<div class="row">
				<h3 class="text-center">Step 1: Product Details</h3>
			</div>
		</div>
	</div>

	<div class="content-fix">
		<div class="container">

			<div class="row mt-20 mb-20">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div>
						<h4 class="font16 bold-600">Please provide the following product details</h4>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-6">
							<div class="input-group">
								<select class="" id="brand_id" name="brand_id">
									<option value="" disabled selected>Please select your brand</option>
									@foreach($brands as $brand)
									<option value="{{ $brand->id }}" {{ (!empty($product->brand_id) ? $product->brand_id : '') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
									@endforeach
								</select>
								<div class="input-group-btn">
									<button class="btn btn-dark h-34" type="submit">
										ADD NEW
									</button>
								</div>
							</div>
							@if ($errors->has('brand_id'))
							<span class="inputError">{{ $errors->first('brand_id') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6">	
							<div class="input-group">
								<select class="" id="product_line_id" name="product_line_id">
									<option value="" disabled selected>Please select your product line</option>
									@if( !empty( $proline ) )
									@foreach( $proline as $pro )
									<option value="{{ $pro->id }}" {{ $product->product_line_id == $pro->id ? 'selected' : '' }}>{{ $pro->productline_name }}</option>
									@endforeach
									@endif
								</select>
								<div class="input-group-btn">
									<button class="btn btn-dark h-34" type="submit">
										ADD NEW
									</button>
								</div>
							</div>
							@if ($errors->has('product_line_id'))
							<span class="inputError">{{ $errors->first('product_line_id') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="product_name" id="product_name" placeholder="Please enter your product name:" value="{{ !empty($product->product_name) ? $product->product_name : old('product_name') }}">
							@if ($errors->has('product_name'))
							<span class="inputError">{{ $errors->first('product_name') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="product_code" id="product_code" placeholder="Please enter your product code:" value="{{ !empty($product->product_code) ? $product->product_code : old('product_code') }}">
							@if ($errors->has('product_code'))
							<span class="inputError">{{ $errors->first('product_code') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="product_size" id="product_size" placeholder="Please enter your product size:" value="{{ !empty($product->product_size) ? $product->product_size : old('product_size') }}">
							<div class="btn-search">
								ml/Oz
							</div>
							@if ($errors->has('product_size'))
							<span class="inputError">{{ $errors->first('product_size') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6">
							<div class="upload-btn-wrapper">
								<button class="form-control text-left">Upload image: (Up to 300px by 300px in Jpeg < 2MB)</button>
								<div class="inner-addon right-addon">
									<i class="ti-plus"></i>
									<input type="file" name="product_image" id="product_image" />
								</div>
							</div>
							@if ($errors->has('product_size'))
							<span class="inputError">{{ $errors->first('product_image') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<textarea class="form-control" name="product_text" id="product_text" rows="3" placeholder="please enter your product">{{ !empty($product->product_text) ? $product->product_text : old('product_text') }}</textarea>
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" name="" id="" placeholder="Password:" value="" readonly>
						</div>
					</div>
					@if( !empty($product) )
					<input type="hidden" value="update" name="check_data">
					<input type="hidden" name="id" value="{{ $product->id }}">
					<input type="hidden" name="old_image_name" value="{{ $product->product_image }}">
					@endif
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
@section('scripts')
<script>
	$(document).ready(function(e) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_mytoken"]').attr('content')
			}
		});
		// alert('here');
		$('#brand_id').change(function() {
			if( $(this).val() != '' )
			{
				$.ajax({
					type: "GET",
					url: "{{ route('getproductlinebybrand') }}",
					data: {
						brand_id: $(this).val()
					},
					success: function(result) {
						$('#product_line_id').html(result);
					},
					error: function() {
						alert('error');
					}
				});
			}
		})
	});
</script>
@endsection