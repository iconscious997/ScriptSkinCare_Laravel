@extends('layouts.master')
@section('content')
<form action="{{ url('/retailuserstore') }}" method="POST" id="first">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">RETAIL USER</h3>
            </div>
        </div>
    </div>
    <div class="content-fix wow fadeIn" data-wow-duration="2s" >
        <div class="container">
            <div class="row mt-20 mb-20">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-md-6">
                        <div class="row">
                            <h4 class="bold-700 font17 mb-5" >RETAIL USER:</h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-10">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 pull-left p-r-0">
                                <button class="btn btn-dark btn-block" type="button" id="viewexistinguser"> VIEW / EDIT EXISTING USERS</button>

                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 pull-right p-l-0">
                                <button class="btn btn-dark btn-block m-l-15" type="button" id="addadditionaluser"> + ADD ADDITIONAL USER</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="form-group col-md-6">
                            @if ( !empty($retailuser) )
                            <input type="hidden" name="id" value="{{ $retailuser->id }}">
                            @endif
                           

                            @if ( Session::has('retail_site_id') )
                            <input type="hidden"  id="clinic_id" value="{{ Session::get('retail_site_id') }}">
                            @endif
                           
                            <input type="hidden" name="whattodo" id="whattodo" value="update">
                            <input type="hidden" name="savestep" id="savestep" value="0">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name:" value="{{ !empty($retailuser->first_name) ? $retailuser->first_name : old('first_name') }}">
                            @if ($errors->has('first_name'))
                            <span class="inputError">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name:" value="{{ !empty($retailuser->last_name) ? $retailuser->last_name : old('last_name') }}">
                            @if ($errors->has('last_name'))
                            <span class="inputError">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="telephone_number" id="telephone_number" placeholder="Business Telephone No:" value="{{ !empty($retailsite->telephone_number) ? $retailsite->telephone_number : old('telephone_number') }}">
                            @if ($errors->has('telephone_number'))
                            <span class="inputError">{{ $errors->first('telephone_number') }}</span>
                            @endif
                        </div>
                         <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="clinic_location" id="clinic_location" placeholder="Business Address:" value="{{ !empty($retailsite->clinic_location) ? $retailsite->clinic_location : old('clinic_location') }}">
                            @if ($errors->has('clinic_location'))
                            <span class="inputError">{{ $errors->first('clinic_location') }}</span>
                            @endif
                        </div>

                    </div>
                   
                    <div class="row">
                        @php $selected_role = old('user_role') @endphp
                        @if( !empty($user_selected_role->role_id) ) 
                        @php $selected_role = $user_selected_role->role_id; @endphp
                        <input type="hidden" name="user_selected_role" value="{{$user_selected_role->role_id}}">
                        @endif
                        <div class="form-group col-md-6">
                            <select name="user_role" id="user_role">
                                <option value="">Select User Role</option>
                                @foreach( $roles as $role )
                                <option {{ $selected_role == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->label }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_role'))
                            <span class="inputError">{{ $errors->first('user_role') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile No:" value="{{ !empty($retailuser->mobile_number) ? $retailuser->mobile_number : old('mobile_number') }}">
                            @if ($errors->has('mobile_number'))
                            <span class="inputError">{{ $errors->first('mobile_number') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" {{ !empty($user->email) ? 'readonly' : '' }} name="email" id="email" placeholder="Email Address:" autocomplete="new-password" value="{{ !empty($user->email) ? $user->email : old('email') }}">
                            @if ($errors->has('email'))
                            <span class="inputError">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" {{ !empty($user->email) ? 'readonly' : '' }} class="form-control" name="password" id="password" placeholder="Password:" autocomplete="new-password" value="{{ !empty($user->email) ? '******' : '' }}">
                            @if ($errors->has('password'))
                            <span class="inputError">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">


                            <select name="user_parent_id" id="user_parent_id">
                                <option value="">Select User</option>
                                @foreach( $retail_admin as $role )
                                <option  value="{{ $role['id'] }}" {{ isset($retailuser)?($retailuser->user_parent_id == $role['id'] ? 'selected' : ''):('') }}>{{ $role['first_name'] }}  {{ $role['last_name'] }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('user_parent_id'))
                            <span class="inputError">{{ $errors->first('user_parent_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="position" id="position" placeholder="Position :" value="{{ !empty($retailuser->position) ? $retailuser->position : old('position') }}">
                        @if ($errors->has('position'))
                        <span class="inputError">{{ $errors->first('position') }}</span>
                        @endif
                    </div>
                    </div>

                   
                <div class="col-md-1">&nbsp;</div>

            </div>
        </div>
        <div class="row mt-40 mb-10">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10 text-center">
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15">
                        <a href="{{ route('retailadd') }}" class="prev" id="prevBtn"><i class="ti-arrow-left"></i> &nbsp;PREVIOUS</a>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <ul class="pagination pagination-split">
                            <li class="page-item "><span class="page-link">1</span></li>
                            <li class="page-item active"><span class="page-link">2</span></li>
                            
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  mt-15 text-right">
                        <a onclick="javascript:$('#first').submit();" class="next" id="nextBtn">FINSH &nbsp;<i class="ti-arrow-right"></i></a>

                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-1">&nbsp;</div>

            <div class="col-md-10 text-center mt-30 mb-10">
                <button class="btn btn-dark" type="button" id="btnsavestep">  Save Changes </button>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
    </div>
</div>
</form>
<div class="footer">
    <div class=" text-center">
        <div class="">
            <div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <a href="{{ url('/new-retail') }}" ><button type="button" class="btn btn-default ripple spbtn"> + ADD NEW RETAIL</button></a>

                <a href="{{ url('/new-retail-user') }}" > <button type="button" class="btn btn-default ripple spbtn m-l-20"> + ADD A NEW USER</button></a>

            </div>
            <div class="col-md-1 col-sm-1 hidden-xs">&nbsp;</div>
        </div>
    </div>
</div>
</form>
<script>
    $(document).ready(function() {
        $('#btnsavestep').on('click', function(e) {
        // set the savestep to 1 so we can track that we have to redirect to next or not
        $('#savestep').val(1);
        $('#first').submit();
    });

        $('#addadditionaluser').on('click', function(e) {
        // clear all fields
        $('#first_name').val('');
        $('#last_name').val('');
        $('#supplier_name').val('');
        $('#telephone_number').val('');
        $('#clinic_location').val('');
        $('#business_address_line_2').val('');
        $('#user_role').val('');
        $('#mobile_number').val('');
        $('#position').val('');
        $('#email').val('').removeAttr('readonly');
        $('#password').val('').removeAttr('readonly');
        $('#whattodo').val('new');
    });

        $('#viewexistinguser').on('click', function(e) {
            var spid = $('#supplier_parent_id').val();
            var clinic_id = $('#clinic_id').val();
            var html = '';
            // if( spid != undefined ) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo url('/get_list_of_retail_user')?>/"+clinic_id,
                    success: function(data) {  

                    // alert("hii");
                    
                    $('#supplier_list').append(data);
                },

            })

            // } else {
            //     html += '<p>No User Found</p>';
            // }
                // get data and show in modal popup
                $('#modal-data').html(`<div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">List Users</h4>
                    </div>
                    <div class="modal-body">
                    <table class="table display" id="customers">
                    <thead class="thead-dark">
                    <tr>
                    <th>Name</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody  id="supplier_list">
                    </tbody>
                    </table>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>`);
                $('#myModal').modal();
            });
    });
</script>
@endsection