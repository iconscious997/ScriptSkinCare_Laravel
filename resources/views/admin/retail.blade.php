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

<div class="wizard spcust">
    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left">
        <h3 class="text-left mt-20">RETAIL LIST / RESULTS</h3>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15 text-right">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-6 hidden-xs">&nbsp;</div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <a href="{{ url('/retailadd') }}" class="btn btn-default m-l-5 btn-block"> + ADD NEW RETAIL</a>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
           <div class="dropdown export">
            <button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
                <span class="caret"></span></button>
                <ul class="dropdown-menu"  id="buttons">

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
                    <th>Business Name</th>
                    <th>Trading Name</th>
                    <th>Business Address</th>
                    <th>Business Phone</th>
                    <th>Business Website</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Permission Status</th>
                    <th>Status</th>                        
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $i=0 @endphp
                @foreach($data as $item)
                <tr>
                    <td>{{$item->clinic_name}}</td>
                    <td>{{$item->trading_name}}</td>
                    <td>{{$item->clinic_location}}</td>
                    <td>{{$item->telephone_number}}</td>
                    <td>{{$item->clinic_website}}</td>                            
                    <td>{{$item->first_name}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->position}}</td>
                    <td>{{$item->label}}</td>
                    <td>{{$item->clinic_status==0 ? 'Activated' : 'Deactived'}}</td>                           
                    <td class="flex">                                 
                        <a href='javascript:void()' class='deactivaterow' msg="{{$item->clinic_status==1 ? 'Activate' : 'Deactivate'}}" msgconf="{{$item->clinic_status==1 ? 'Activated' : 'Deactivated'}}" data-id={{$item->clinic_id}}><button class="btn btn-default m-l-5">{{$item->clinic_status==1 ? 'ACTIVATE' : 'DEACTIVATE'}}</button></a>
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
                                Search Retail List
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="clearfix">&nbsp;</div>
                            <div class="accordionblock">
                                <div class="row">

                                    <form action="{{ url('/retail') }}" method="post">
                                        @csrf
                                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="business_name" placeholder="Business Name:" value="{{$request->business_name}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="first_name" placeholder="First Name:" value="{{$request->first_name}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="position" placeholder="Position:" value="{{$request->position}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="business_telephone_number"  value="{{$request->business_telephone_number}}"placeholder="Business Phone No:">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="last_name"  value="{{$request->last_name}}" placeholder="Last Name:">
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
                    title: 'Customers',
                    extend: 'excelHtml5',
                    // className: 'btn btn-success',
                    exportOptions: {
                        columns: [  0,1,2,3,4,5,6,7,8,9,10 ]
                    }
                } ),   
       $.extend( true, {}, {
                    // footer: true,
                    title: 'Customers',
                    extend: 'csvHtml5',
                    // className: 'btn btn-danger',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6,7,8,9,10 ]
                    }
                } ),
       $.extend( true, {}, {
                    // footer: true,
                    title: 'Customers',
                    extend: 'pdfHtml5',
                    // className: 'btn btn-danger',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6,7,8,9,10 ]
                    }
                } )
       ]
   }).container().appendTo($('#buttons'));           
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
            url: "<?php echo url('/clinicactivedeactive')?>/"+id+"/"+status,
            success: function(data) {                             
                swal({
                    title: msg+'!',
                    text: 'Retail has been '+msg+'.',
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

