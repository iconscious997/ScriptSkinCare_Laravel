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

	<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left mt-5">
		<h3 class="text-left">Sales Orders</h3>
	</div>
	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15 ">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pull-right">
				<div class="dropdown export">
					<button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
						<span class="caret"></span></button>
						<ul class="dropdown-menu"  id="buttons">

						</ul>
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
						<th>Order</th>
						<th>Customer </th>
						<th>Date</th>
						<th>Status</th>
						<th>Total </th>
						<th>Invoice </th>
						<th>Packing List</th>
						<th>Order Type</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@for($i=0; $i<5; $i++) 
					<tr>
						<td class="p-10">FC100</td>
						<td class="p-10">Niraj </td>
						<td class="p-10">19th Oct 208</td>
						<td class="p-10">Placed</td>
						<td class="p-10">1000</td>
						<td class="p-10">L'oreal Australia Pty Ltd</td>
						<td class="p-10">PKP100</td>
						<td class="p-10">COD</td>
						<td class="p-10">
							<i class=" ti-check"></i> &nbsp;&nbsp; 
							<i class=" ti-close"></i>
						</td>
					</tr>
					@endfor                        
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
									Search Sales Data (Filter)
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<div class="clearfix">&nbsp;</div>
								<div class="accordionblock">
									<div class="row">
										<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Order ID:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Transaction ID:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Sale Source:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Sale by User:">
											</div>
										</div>
										<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Date Range: From">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Date Range: To">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Sale by Brand:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Products Sold:">
											</div>
										</div>
										<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Customer First Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Customer Last Name:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Customer Email:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Delivery Address:">
											</div>
										</div>
										<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Delivery Method:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Payment Status:">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="" placeholder="Order Status (If required):">
											</div>
											<div class="form-group">
												<button class="btn btn-default col-md-6 col-xs-12 font12 p-7 pull-right">VIEW RESULTS</button>
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

