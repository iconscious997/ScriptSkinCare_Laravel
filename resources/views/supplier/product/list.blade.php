@extends('supplier.suppliermaster')
@section('content')
<div class="wizard">

	<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left mt-5">
		<h3 class="text-left">Products List</h3>
	</div>
	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
				<div class="dropdown export">
					<button class="btn btn-dark m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
						<span class="caret"></span></button>
						<ul class="dropdown-menu" id="buttons">
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
					<button class="btn btn-dark m-l-5 btn-block" onclick="location.href='{{ route('supplierproductadd') }}';"> + ADD NEW PRODUCT</button>
				</div>
			</div>
		</div>

	</div>
	<div class="content-fix ">
		<div class="table-responsive mb-30">
			<table class="table display" id="customers">
				<thead class="thead-dark">
					<tr>
						<th>Product Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Product Line</th>
						<th>Product Code</th>
						<th>Barcode</th>
						<th>Approved</th>
						<th>Product Status</th>
						<th>Actions</th>
					</tr>
					<tbody>
						
						@php $i=0 @endphp
						@foreach($data as $item)

						<tr>
							<td>{{$item->business_name}}</td>
							<td>{{$item->trading_name}}</td>
							<td>{{$item->business_address_line_1}}{{$item->business_address_line_2}}{{$item->city}}{{$item->state}}{{$item->country}}</td>
							<td>{{$item->business_telephone_number}}</td>
							<td>{{$item->website}}</td>
							<td>{{$all_brand_name[$i]}}</td>
							<td>{{$item->first_name}} {{$item->last_name}}</td>
							<td>{{$item->label}}</td>
							<td>{{$item->email}}</td>
							<td><a class="btn btn-green"> RESET</a></td>
							<td >
								<i class=" ti-check"></i> &nbsp;&nbsp; 
								<i class=" ti-close"></i>
							</td>
							{{-- <td class="flex">
								<button class="btn btn-green "> SAVE</button> 
								<button class="btn btn-green m-l-5"> UNDO</button>
							</td> --}}
						</tr>
						
						@php $i++ @endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div id="footer">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Search Product List
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<div class="clearfix">&nbsp;</div>
									<div class="accordionblock">
										<div class="row">

											<form action="{{ url('/supplier') }}" method="post">
												@csrf
												<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control" name="business_name" placeholder="Company:" value="{{ isset($request->business_name) ? $request->business_name : '' }}">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="first_name" placeholder="First Name:" value="{{ isset($request->first_name) ? $request->first_name : '' }}">
													</div>
												</div>
												<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control" name="business_telephone_number"  value="{{ isset($request->business_telephone_number) ? $request->business_telephone_number : '' }}"placeholder="Business Phone No:">
													</div>
													<div class="form-group">
														<select class="form-control" name="pstatus">
															<option value="">Select Permission Status</option>
															@foreach( $all_roles as $role )

															<option  value="{{ $role['id'] }}" {{ isset($request->pstatus)?($request->pstatus== $role['id'] ? 'selected' : ''):('') }}>{{ $role['label'] }}</option>

															@endforeach
														</select>	
													</div>
												</div>
												
												<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
													<div class="form-group">
														&nbsp;
													</div>
													<div class="form-group">
														<button class="btn btn-default font12 mt-5 width100 p-7">APPLY FILTER</button>
													</div>
												</div>

											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				var table = $('#customers').DataTable();
				var buttons = new $.fn.dataTable.Buttons(table, {
					extend: 'collection',
					text: 'Export', 
					buttons: [
					$.extend( true, {}, {
                    // footer: true,
                    title: 'Suppliers',
                    extend: 'excelHtml5',
                    // className: 'btn btn-success',
                    exportOptions: {
                    	columns: [0,1,2,3,4,5,6,7,8]
                    }
                } ),   
					$.extend( true, {}, {
                    // footer: true,
                    title: 'Suppliers',
                    extend: 'csvHtml5',
                    // className: 'btn btn-danger',
                    exportOptions: {
                    	columns: [0,1,2,3,4,5,6,7,8]
                    }
                } ),
					$.extend( true, {}, {
                    // footer: true,
                    title: 'Suppliers',
                    extend: 'pdfHtml5',
                    // className: 'btn btn-danger',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                    	columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                } )
					]
				}).container().appendTo($('#buttons'));           
			} );
			

		</script>
@endsection
@section('scripts')
@include('layouts.datatablejs')
@endsection