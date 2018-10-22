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

<div class="wizard spcust">
    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left">
        <h3 class="text-left mt-20">Search Retail</h3>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15 text-right">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
         
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <div class="dropdown export">
                <button class="btn btn-default m-l-5 btn-block btn-transparent dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#">Export PDF</a></li>-->
                        {{--    <li><a href="javascript:void(0)"  onClick ="$('#customers').tableExport({type:'excel',escape:'false',tableName:'yourTableName'});">Export Excel</a></li> --}}
                        <li><a href="{{ route('customers', ['export' => 'yes' ]) }}" >Export Excel</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <button type="button" class="btn btn-green m-l-5 btn-block"> + ADD NEW RETAIL</button>
            </div>
        </div>
    </div>
    <div class="content-fix ">
        <div class="table-responsive mb-30">
            <table class="table display" id="customers">
                <thead class="thead-dark">
                    <tr>
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>Users</th>
                        <th>User Role</th>
                        <th>User Email</th>                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0 @endphp
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item->clinic_name}}</td>                            
                            <td>{{$item->business_address_line_1}}{{$item->business_address_line_2}}{{$item->city}}{{$item->state}}{{$item->country}}</td>
                            <td>{{$item->mobile_number}}</td>
                            <td>{{$item->website}}</td>                            
                            <td>{{$item->first_name}} {{$item->first_name}}</td>
                            <td>{{$item->label}}</td>
                            <td>{{$item->email}}</td>                            
                            <td class="flex">
                               <a href='customeredit/{{$item->id}}' data-id={{$item->id}}><button type="button" class="btn btn-default "> EDIT</button></a> 
                               <!--  <a href='javascript:void()' class='deactivaterow' msg="{{$item->status==1 ? 'Activate' : 'Deactivate'}}" data-id={{$item->id}}><button class="btn btn-default m-l-5">{{$item->status==1 ? 'ACTIVATE' : 'DEACTIVATE'}}</button></a> -->
                            </td>                         
                        </tr>                        
                        @php $i++ @endphp
                        @endforeach                               
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer p-10">
        <div class="conatiner text-center">
            <div class="row">
                <div class="col-md-1 col-sm-1">&nbsp;</div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="col-md-12 text-center mt-20 mb-10">
                        <a href="{{ route('customeradd') }}" class="btn btn-light spbtn">
                            + ADD A NEW CUSTOMER
                        </a>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1">&nbsp;</div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#customers').DataTable();
        } );

        $(document).on("click", ".deactivaterow", function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var msg = $(this).attr('msg');
            var status = 0;
            if(msg == 'Deactivate') {
                status = 1;
            }
            swal({
                title: 'Are you sure?',
                text: "You want to "+msg+"!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, '+msg+'',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
        // call ajax function to delete it
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_mytoken"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "<?php echo url('/customeractivedeactive')?>/"+id+"/"+status,
            success: function(data) {             
                swal({
                    title: msg+'!',
                    text: 'Customer has been '+msg+'.',
                    type: 'success'
                }).then(function() {
                    location.reload();
                });
            },
            error: function() {
                alert('error');
            }
        })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
    })

        })
    </script>
    @endsection

