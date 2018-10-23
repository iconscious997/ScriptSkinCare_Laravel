@extends('layouts.master')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
	border-radius: 0; 
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
and (orientation : portrait) { 
	#footer {
		position: relative;
	}
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
		<h3 class="text-left">Supplier List / Results (Products)</h3>
	</div>
	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
				<div class="dropdown export">
					<button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu"  id="buttons"></ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
				<a href="{{ url('/user-supplier-add') }}"><button class="btn btn-default m-l-5 btn-block"> + ADD NEW SUPPLIER</button></a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
				<button class="btn btn-default m-l-5 btn-block"> + ADD NEW PRODUCT</button>
			</div>
		</div>
	</div>
</div>
<div class="content-fix ">
	<div class="table-responsive mb-40">
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
					<th>&nbsp;</th>
				</tr>
				<tbody>
					<?php for($i=0; $i<20; $i++) {?>
					<tr>
						<td>L'oreal Australia Pty Ltd</td>
						<td>L'oreal</td>
						<td>123 L’Oreal Rd</td>
						<td>03 11 22 66 55</td>
						<td>l’oreal.com.au</td>
						<td>La Roche Rosay</td>
						<td>User 1</td>
						<td>Admin</td>
						<td>@loreal.com.au</td>
						<td><a class="btn btn-green"> RESET</a></td>
						<td>
							<i class=" ti-check"></i> &nbsp;&nbsp; 
							<i class=" ti-close"></i>
						</td>
						<td class="flex">
							<button class="btn btn-green "> SAVE</button> 
							<button class="btn btn-green m-l-5"> UNDO</button>
						</td>
					</tr>
					<?php } ?> 
				</tbody>
			</table>
		</div>
	</div>
	<div id="footer">
		<div class="row">
			<div class="col-md-3">
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
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Company:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="First Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Position:">
											</div>
										</div>
										<div class="col-md-6">
											<p>Advanced Search</p>
										</div>
										<div class="col-md-6">
											<p><a class="btn btn-default pull-right"> VIEW RESULTS</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									Search Users
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<div class="clearfix">&nbsp;</div>
								<div class="accordionblock">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Last Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Supplier:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="User Role:">
											</div>
										</div>
										<div class="col-md-6">
											<p>Advanced Search</p>
										</div>
										<div class="col-md-6">
											<p><a class="btn btn-default pull-right"> VIEW RESULTS</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									Search Brands
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">
								<div class="clearfix">&nbsp;</div>
								<div class="accordionblock">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Brand Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Supplier:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="User Status:">
											</div>
										</div>
										<div class="col-md-6">
											<p>Advanced Search</p>
										</div>
										<div class="col-md-6">
											<p><a class="btn btn-default pull-right"> VIEW RESULTS</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingFour">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
									Search Products
								</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingFour">
							<div class="panel-body">
								<div class="clearfix">&nbsp;</div>
								<div class="accordionblock">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Brand:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Product Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="User:">
											</div>
										</div>
										<div class="col-md-6">
											<p>Advanced Search</p>
										</div>
										<div class="col-md-6">
											<p><a class="btn btn-default pull-right"> VIEW RESULTS</a></p>
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

