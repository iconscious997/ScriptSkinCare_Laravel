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
        <h3 class="text-left">SUPPLIER LIST / RESULTS ({{$request->search?$request->search:'Products'}})</h3>
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
                    {{-- <th>Actions</th> --}}
                    
                </tr>
                <tbody>
                    @php $i=0 @endphp
                    @foreach($data as $item)
                    <?php if($all_brand_name[$i]){ ?>
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
                        <td><a class="btn btn-dark preset" fname="{{$item->first_name}}" lname="{{$item->last_name}}" mid="{{$item->user_id}}" > RESET</a></td>
                        {{--    <td >
                                <i class=" ti-check"></i> &nbsp;&nbsp; 
                                <i class=" ti-close"></i>
                            </td> --}}
                            {{-- <td class="flex">
                                <button class="btn btn-green "> SAVE</button> 
                                <button class="btn btn-green m-l-5"> UNDO</button>
                            </td> --}}
                        </tr>
                        <?php }?>
                        @php $i++ @endphp
                        @endforeach    
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
                                        Search Suppliers 
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="accordionblock">
                                        <div class="row">

                                            <form action="{{ url('/supplier-list2') }}" method="post">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <select class="form-control" name="company_id" id="company_id">
                                                            <option value="">Select Registered Business Name</option>
                                                            @foreach( $company as $role )
                                                            <option  value="{{ $role['id'] }}" {{ isset($request)?($request->company_id == $role['id'] ? 'selected' : ''):('') }} >{{ $role['business_name'] }}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="email" placeholder="Email:" value="{{$request->position}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="advsearch">Advanced Search</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="search" value="Supplier">
                                                    <p>
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
                <div class="col-md-3">
                    <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Search Users
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="accordionblock">
                                        <div class="row">
                                            <form action="{{ url('/supplier-list2') }}" method="post">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name:" value="{{$request->last_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                       <select class="form-control" name="user_parent_id" id="user_parent_id">
                                                          <option value="">Select Supplier</option>
                                                          @foreach( $supplier_admin as $role )
                                                          <option  value="{{ $role['id'] }}" {{ isset($request)?($request->user_parent_id == $role['id'] ? 'selected' : ''):('') }}>{{ $role['first_name'] }}  {{ $role['last_name'] }}</option>

                                                          @endforeach
                                                      </select>
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
            <div class="col-md-3">
                <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Search Brands
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <div class="clearfix">&nbsp;</div>
                                <div class="accordionblock">
                                    <div class="row">
                                        <form action="{{ url('/supplier-list2') }}" method="post">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="brand_id" id="brand_id">
                                                      <option value="">Select Brand</option>
                                                      @foreach( $all_brand as $role )
                                                      <option  value="{{ $role['id'] }}" {{ isset($request)?($request->brand_id == $role['id'] ? 'selected' : ''):('') }}>{{ $role['brand_name'] }}</option>

                                                      @endforeach
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                <select class="form-control" name="user_parent_id_barnd" id="user_parent_id">
                                                  <option value="">Select Supplier</option>
                                                  @foreach( $supplier_admin as $role )
                                                  <option  value="{{ $role['id'] }}" {{ isset($request)?($request->user_parent_id_barnd == $role['id'] ? 'selected' : ''):('') }}>{{ $role['first_name'] }}  {{ $role['last_name'] }}</option>

                                                  @endforeach
                                              </select>
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
                                        <input type="hidden" name="search" id="brand_search" value="Brands">
                                        <p>
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
    <div class="col-md-3">
        <div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
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
                                    <p class="advsearch">Advanced Search</p>
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
<!-- The Modal -->
<div class="modal" id="myPModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reset Password for <span id="mfname"></span> <span id="mlname"></span></h4>
      </div>

      <!-- Modal body -->
      <form action="{{ url('/updatesupplierpassword') }}" onsubmit="return  validations_password();" method="post">
        @csrf
        <input type="hidden" name="hmid" id="hmid" value="">
        <input type="hidden" name="supplier_id" value="{{$id}}">
        <input type="hidden" name="supplier_list" value="2">
        <div class="modal-body">              
            <div class="form-group">
                <input type="password" class="form-control" id="newpassword" name="newpassword"  value="" placeholder="New Password">
                <span class="inputError" id="newpasserror"></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  value="" placeholder="Confirm Password">
                <span class="inputError" id="confirmpasserror"></span>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">                                        
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">&nbsp;</div>                   
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <button type="submit" class="btn btn-dark btn-block">Submit</button>
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

</script>
@endsection

