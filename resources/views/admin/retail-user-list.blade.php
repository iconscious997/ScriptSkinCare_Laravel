@extends('layouts.master')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
	border-radius: 0; 
}
</style>
<script type="text/javascript" src="{{ asset('assets/js/2jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/3dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/export-sheet/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/export-sheet/jquery.base64.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/export-sheet/jspdf/libs/sprintf.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/export-sheet/jspdf/jspdf.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/export-sheet/jspdf/libs/base64.js') }}"></script>

<div class="wizard">
	<div class="container">
		<div class="row">
			<h3 class="text-center">MANAGE RETAIL USER</h3>
		</div>	
	</div>
</div>

<div class="content-fix ">
	<div class="table-responsive mb-30">
		<table class="table display" id="customers">
			<thead class="thead-dark">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>User Parent Name</th>
					<th>Registered Business Name</th>
					<th>Address</th>
					<th>Business Tellphone Number</th>
					<th>Phone Number</th>
					<th>User Role</th>
					<th>Email</th>
					<th>Actions</th>
					
				</tr>
				<tbody>
					
					@php $i=0 @endphp
					@foreach($data as $item)

						<tr>
							<td>{{$item->first_name}}</td>
							<td>{{$item->last_name}}</td>
							<td>{{$user_parent_name[$i]}}</td>
							<td>{{$item->clinic_name}}</td>
							<td>{{$item->address_line_1}}{{$item->address_line_2}}{{$item->city}}{{$item->state}}{{$item->country}}</td>
							<td>{{$item->business_tel_number}}</td>
							<td>{{$item->mobile_number}}</td>
							<td>{{$item->label}}</td>
							<td>{{$item->email}}</td>
							
							<td >
								  <a href='retail-user-edit/{{$item->id}}'><button type="button" class="btn btn-default "> EDIT</button></a> 
							</td>
							
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
										Search Manage User Retail List
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<div class="clearfix">&nbsp;</div>
									<div class="accordionblock">
										<div class="row">

						<form action="{{ url('/retail-user-list') }}" method="post">
@csrf
											<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<input type="text" class="form-control" name="first_name" placeholder="First Name:" value="{{$request->first_name}}">
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
													<input type="text" class="form-control" name="last_name"  value="{{$request->last_name}}" placeholder="Last Name:">
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
													<input type="text" class="form-control" name="email" value="{{$request->email}}" placeholder="Email:">
												</div>
											
											</div>
											<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<input type="text" class="form-control datepicker"  name="create_date"  value="{{$request->create_date}}" placeholder="Date Created:" readonly="">
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
				$('#customers').DataTable();
			});
			$(".excel").click(function () {
				$('#customers').tableExport({
					type: 'excel',
					escape: 'false',
					tableName: 'ResolutionReport'

				});
				});
			</script>
			@endsection

