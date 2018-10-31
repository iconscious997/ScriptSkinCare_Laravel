@extends('layouts.master')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
    border-radius: 0; 
}
</style>
<script type="text/javascript" src="{{ asset('assets/js/2jquery.dataTables.min.js') }}"></script>
<form action="" method="" id="first">

    <div class="wizard spcust">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left">
            <h3 class="text-left mt-20">Online Orders</h3>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15 text-right">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6 hidden-xs">&nbsp;</div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <button type="button" class="btn btn-default m-l-5 btn-block"> SORT / ARRANGE BY</button>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <div class="dropdown export">
                    <button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#">Export PDF</a></li>-->
                        <li><a href="javascript:void(0)"  onClick ="$('#customers').tableExport({type:'excel',escape:'false',tableName:'yourTableName'});">Export Excel</a>
                        </li>
                    </ul>
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
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Invoice</th>
                        <th>Packing List</th>
                        <th>Order</th>
                        <th>Type</th>
                        <th>
                            <select class="form-control input-sm bordernone" name="" onchange="">
                                <option selected="" disabled="">Bulk Actions</option>
                                <option value="1">Move to Trash</option>
                                <option value="2">Change status to processing</option>
                                <option value="3">Change status to on-hold</option>
                                <option value="4">Change status to completed</option>
                                <option value="5">Remove personal data</option>
                                <option value="6">Print Invoice</option>
                                <option value="7">Send Email Invoice</option>
                                <option value="8">Print Packing List</option>
                                <option value="9">Send Email Packing List</option>
                                <option value="10">Print Pick List</option> 
                                <option value="11">Send Email Pick List</option> 
                            </select>
                        </th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0; $i<5; $i++) 
                    <tr>
                        <td>L'oreal Australia Pty Ltd</td>
                        <td>19 Oct 2018 </td>
                        <td>Placed</td>
                        <td>1000</td>
                        <td>ready</td>
                        <td>ready</td>
                        <td>L'oreal Australia Pty Ltd</td>
                        <td>COD</td>
                        <td></td>
                        <td>
                            <i class=" ti-check"></i> &nbsp;&nbsp; 
                            <i class=" ti-close"></i>
                        </td>
                        <td class="flex">
                            <button class="btn btn-green "> SAVE</button> 
                            <button class="btn btn-green m-l-5"> UNDO</button>
                        </td>
                    </tr>
                    @endfor                        
                </tbody>
            </table>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#customers').DataTable();
    } );
</script>
@endsection