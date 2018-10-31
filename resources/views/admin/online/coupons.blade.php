@extends('layouts.master')
@section('content')
<style type="text/css">
.pagination > li > a, .pagination > li > span {
    border-radius: 0; 
}
</style>
<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

<form action="" method="" id="first">

    <div class="wizard">
        <div class="col-md-12">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left">
                <h3 class="text-left mt-20">Coupons</h3>
            </div>
            <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15 text-right p-0">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6 hidden-xs">&nbsp;</div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
                    <button type="button" class="btn btn-default m-l-5 btn-block"> CREATE A NEW COUPON </button>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
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
    </div>

    <div class="content-fix ">
        <div class="table-responsive mb-30">
            <table class="table display" id="customers">
                <thead class="thead-dark">
                    <tr>
                        <th>Code</th>
                        <th>Coupon type</th>
                        <th>Coupon amount</th>
                        <th>Description</th>
                        <th>Product IDs </th>
                        <th>Usage / Limit </th>
                        <th>Expiry date</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0; $i<5; $i++) 
                    <tr>
                        <td>FC100</td>
                        <td>Discount </td>
                        <td>1000</td>
                        <td>L'oreal Australia Pty Ltd</td>
                        <td>PKP100</td>
                        <td>100</td>
                        <td>19th Oct 208</td>
                        <td>
                            <i class=" ti-check"></i> &nbsp;&nbsp; 
                            <i class=" ti-close"></i>
                        </td>
                        <td class="flex">
                            <button class="btn btn-default "> SAVE</button> 
                            <button class="btn btn-default m-l-5"> UNDO</button>
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
@section('scripts')
@include('layouts.datatablejs')
@endsection