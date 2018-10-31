@extends('supplier.suppliermaster')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
	border-radius: 0; 
}
</style>

<div class="wizard bg3">
	<div class="col-md-12">
		<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left mt-10">
			<h3 class="text-left">{{Session::get('company_name')}}</h3>
		</div>
		<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">

					<button class="btn btn-default m-l-5 btn-block" onclick="location.href='{{ route('supplierproductline') }}';"> + ADD NEW PRODUCT LINE</button>

				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
					<button class="btn btn-default m-l-5 btn-block" onclick="location.href='{{ route('supplieruseradd') }}';"> + ADD NEW USER</button>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
					<div class="dropdown export">
						{{-- <button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
							<span class="caret"></span></button>
							<ul class="dropdown-menu"  id="buttons">

							</ul> --}}
						</div>
					</div>
				</div>
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
						<th>Business Telephone Number</th>
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
							<td>{{$item->business_name}}</td>
							<td>{{$item->business_address_line_1}}{{$item->business_address_line_2}}{{$item->city}}{{$item->state}}{{$item->country}}</td>
							<td>{{$item->business_tel_number}}</td>
							<td>{{$item->mobile_number}}</td>
							<td>{{$item->label}}</td>
							<td>{{$item->email}}</td>
							
							<td >
								  <a href='useredit/{{$item->id}}'><button type="button" class="btn btn-default "> EDIT</button></a> 
							</td>
							
						</tr>
						
						@php $i++ @endphp
					    @endforeach    


					</tbody>
				</table>
			</div>
		</div>
		<div  id="advfilter" class="width50">
			<div class="col-md-6 col-xs-12 col-ms-6">
				<div class="advance-filter">
					<div class="row filter-advance">
						<div class="col-md-12">
							<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
												Search Brands
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
										<div class="panel-body">
											<div class="clearfix">&nbsp;</div>
											<div class="accordionblock">
												<div class="row">
													<form action="{{ url('/supplier/user') }}" method="post">
														@csrf
														<div class="col-md-12">
															<div class="form-group">
																<input type="text" class="form-control" name="brand_name" placeholder="Brand Name:" value="{{$request->brand_name}}">
															</div>

															<div class="form-group">
																<input type="text" class="form-control" name="supplier_name" placeholder="Supplier: [Default By Log-In]" value="{{Session::get('supplier_first_name')}} {{Session::get('supplier_last_name')}}" readonly="">
															</div>

															<div class="form-group">
																<select class="form-control" name="status">
					                                                <option value="">Select Status</option>
					                                                <option value="0"{{ isset($request->status)?($request->status==0 ? 'selected' : ''):('') }} >Active</option>
					                                                <option value="1"{{ isset($request->status)?($request->status== 1 ? 'selected' : ''):('') }} >Deactive</option>
					                                            </select>
															</div>
														</div>
														<div class="col-md-6">
															<p class="advsearch">Advanced Search</p>
														</div>
														<div class="col-md-6">
															<p>
																<input type="hidden" name="search" value="Brands">
																<button class="btn btn-default pull-right" type="submit">VIEW RESULTS</button>
															</p>

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
			</div>
			<div class="col-md-6 col-xs-12 col-ms-6">
				<div class="advance-filter">
					<div class="row filter-advance">
						<div class="col-md-12">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Search Users
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<div class="clearfix">&nbsp;</div>
											<div class="accordionblock">
												<div class="row">
													<form action="{{ url('/supplier/user') }}" method="post">
												@csrf
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="last_name" placeholder="Last Name:" value="{{$request->last_name}}">
													</div>

													<div class="form-group">
														<input type="text" class="form-control" name="email" placeholder="Email:" value="{{$request->email}}">
													</div>

													<div class="form-group">
														 <select class="form-control" name="role_id" id="role_id">
                                                        <option value="">Select User Roles</option>
                                                        @foreach( $all_roles as $role )

                                                        <option  value="{{ $role['id'] }}" {{ isset($request->role_id)?($request->role_id== $role['id'] ? 'selected' : ''):('') }}>{{ $role['label'] }}</option>

                                                        @endforeach
                                                    </select>
													</div>
												</div>
												<div class="col-md-6">
													<p class="advsearch">Advanced Search</p>
												</div>
												<div class="col-md-6">
													<p>
														<input type="hidden" name="search" value="Users">
														<button class="btn btn-default pull-right" type="submit">VIEW RESULTS</button>
													</p>

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
			</div>
		</div>
		<!-- The Modal -->
		<div class="modal" id="myPModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Reset Password for <span id="mfname"></span> <span id="mlname"></span></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<form action="{{ url('/updatesupplierpassword') }}" onsubmit="return  validations_password();"  method="post">
						@csrf
						<input type="hidden" name="hmid" id="hmid" value="">
						<div class="modal-body">		      	
							<div class="form-group">
								<input type="password" class="form-control" name="newpassword"  value="" id="newpassword" placeholder="New Password">
								<span class="inputError" id="newpasserror"></span>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="" placeholder="Confirm Password">
								<span class="inputError" id="confirmpasserror"></span>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="modal-footer">		        			        	
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">&nbsp;</div>		      		
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<button type="submit" class="btn btn-green btn-block">Submit</button>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">                       
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">&nbsp;</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {

				$('.preset').on('click', function(e) {
					$('#mfname').text($(this).attr('fname').toUpperCase());					 
					$('#mlname').text($(this).attr('lname').toUpperCase());					 					
					$('#hmid').val($(this).attr('mid'));					 
					$('#myPModal').modal();
				});

				var table = $('#customers').DataTable(
					 {
					        "order": [[ 0, "desc" ]]
					    } 
					);
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
                    	columns: [0,1,2,3,4,5,6,7,8]
                    }
                } )
					]
				}).container().appendTo($('#buttons'));  

				$('.viewexistinguser').on('click', function(e) {

					var supplier_id = $(this).data("id");            
					$.ajax({
						type: "GET",
						url: "<?php echo url('/get_supplier_all')?>/"+supplier_id,
						success: function(data) {  

							$('#supplier_detail').append(data);
						},

					})

                // get data and show in modal popup
                $('#modal-data').html(`<div class="modal-content">
                	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal">&times;</button>
                	<h4 class="modal-title">Edit `+$(this).data("role")+`</h4>
                	</div>
                	<form action="<?php echo url('/update_supplier_list_data');?>" onsubmit="return  validations_id();" method="POST" >
                	<div class="modal-body" id="supplier_detail">
                	

                	</div>
                	<div class="modal-footer">
                	<button class="btn btn-dark selected" type="submit" id="btnsavestep">SAVE CHANGES</button>
                	<button type="button" class="btn btn-default" data-dismiss="modal">UNDO</button>
                	</div>
                	</form>
                	</div>`);
                $('#myModal').modal();
            });         
			} );

			function validations_password() {

				var isvalid = true;
				if($.trim($("#newpassword").val())=="" || $.trim($("#newpassword").val())==null)
				{
					$("#newpasserror").text("Please enter new password");
					$("#newpassword").focus();
					return false;
				}

				if($.trim($("#confirmpassword").val())=="" || $.trim($("#confirmpassword").val())==null)
				{
					$("#confirmpasserror").text("Please enter confirm password");
					$("#confirmpassword").focus();
					return false;
				}

				if($("#newpassword").val()!=$("#confirmpassword").val())
				{
					$("#confirmpassword").val('');
					$("#confirmpasserror").text("Please enter new password and confirm password must be same.");
					$("#confirmpassword").focus();
					return false;
				}

				if(!isvalid){

					return false;
				}

			}
			function validations_id() {
				// body...
				var isvalid = true;

				if($.trim($("#business_name").val())=="" || $.trim($("#business_name").val())==null)
				{
					$("#businesserror").text("Please enter registered business name");
					$("#business_name").focus();
					return false;
				}
				
				if($.trim($("#trading_name").val())=="" || $.trim($("#trading_name").val())==null)
				{
					$("#trading_nameerror").text("Please enter trading name");
					$("#trading_name").focus();
					return false;
				}

				if($.trim($("#address").val())=="" || $.trim($("#address").val())==null)
				{
					$("#addresserror").text("Please enter address");
					$("#address").focus();
					return false;
				}
				
				if($.trim($("#business_telephone_number").val())=="" || $.trim($("#business_telephone_number").val())==null)
				{
					$("#bustelerror").text("Please enter business telephone");
					$("#business_telephone_number").focus();
					return false;
				}

				if($("#business_telephone_number").val().length<10 || $("#business_telephone_number").val().length> 12)
				{
					$("#bustelerror").text("The business tel number must be between 10 and 12 digits.");
					$("#business_telephone_number").focus();
					return false;
				}


				if($.trim($("#website").val())=="" || $.trim($("#website").val())==null)
				{
					$("#websiteerror").text("Please enter website");
					$("#website").focus();
					return false;
				}
				
				if($.trim($("#brands_data").val())=="" || $.trim($("#brands_data").val())==null)
				{
					$("#brands_dataerror").text("Please select brands");
					$("#brands_data").focus();
					return false;
				}

				if($.trim($("#first_name").val())=="" || $.trim($("#first_name").val())==null)
				{
					$("#firstnameerror").text("Please enter first name");
					$("#first_name").focus();
					return false;
				}
				
				if($.trim($("#last_name").val())=="" || $.trim($("#last_name").val())==null)
				{
					$("#lastnameerror").text("Please enter last name");
					$("#last_name").focus();
					return false;
				}

				if($.trim($("#position").val())=="" || $.trim($("#position").val())==null)
				{
					$("#positionerror").text("Please enter position");
					$("#position").focus();
					return false;
				}

				if($.trim($("#user_role").val())=="" || $.trim($("#user_role").val())==null)
				{
					$("#user_roleerror").text("Please select user role");
					$("#user_role").focus();
					return false;
				}

				if($.trim($("#status").val())=="" || $.trim($("#status").val())==null)
				{
					$("#statuserror").text("Please enter position");
					$("#status").focus();
					return false;
				}

				if(!isvalid){					
					return false;
				}
			}
		</script>
		@endsection

		@section('scripts')
		@include('layouts.datatablejs')
		@endsection