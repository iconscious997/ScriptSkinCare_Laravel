@extends('layouts.master')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
	border-radius: 0; 
}
</style>
<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<div class="wizard">

	<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left mt-5">
		<h3 class="text-left">Supplier List / Results</h3>
	</div>
	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
				<div class="dropdown export">
					<button class="btn btn-dark m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
						<span class="caret"></span></button>
						<ul class="dropdown-menu"  id="buttons">
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
					<a href="{{ url('/user-supplier-add') }}"><button class="btn btn-dark m-l-5 btn-block"> + ADD NEW SUPPLIER</button></a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
					<button class="btn btn-dark m-l-5 btn-block"> + ADD NEW PRODUCT</button>
				</div>
			</div>
		</div>

	</div>
	<div class="content-fix ">
		<div class="table-responsive mb-30">
			<table class="table display" id="customers">
				<thead class="thead-dark">
					<tr>
						<th>Registered Business Name</th>
						<th>Trading Name</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Website</th>
						<th>Brands</th>
						<th>Users</th>
						<th>User Role</th>
						<th>User Email</th>
						<th>Password Reset</th>
						<th>Actions</th>
						{{-- <th>&nbsp;</th> --}}
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
										Search Supplier List
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
														<input type="text" class="form-control" name="business_name" placeholder="Company:" value="{{$request->business_name}}">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="first_name" placeholder="First Name:" value="{{$request->first_name}}">
													</div>
													<div class="form-group">
														<select class="form-control" name="position">
															<option value="">Select Position</option>

														</select>	

													</div>
												</div>
												<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control" name="business_telephone_number"  value="{{$request->business_telephone_number}}"placeholder="Business Phone No:">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="last_name"  value="{{$request->last_name}}" placeholder="Surname:">
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
														<input type="text" class="form-control" name="website" value="{{$request->website}}" placeholder="Website:">
													</div>
													<div class="form-group">
														<input type="text" class="form-control" name="email" value="{{$request->email}}" placeholder="Email:">
													</div>
													<div class="form-group">
														<select class="form-control" name="status">
															<option value="">Select Status</option>
															<option value="0"{{ isset($request->status)?($request->status==0 ? 'selected' : ''):('') }} >Active</option>
															<option value="1"{{ isset($request->status)?($request->status== 1 ? 'selected' : ''):('') }} >Deactive</option>
														</select>

													</div>
												</div>
												<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control datepicker"  name="create_date"  value="{{$request->create_date}}" placeholder="Date Created:" readonly="">
													</div>
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

