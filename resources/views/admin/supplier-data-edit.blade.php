@extends('layouts.master')
@section('content')
<form action="{{ url('/supplierusereditstore') }}" method="POST" id="first">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">EDIT USERS PERMISSIONS</h3>
            </div>
        </div>
    </div>
    <div class="content-fix">
        <div class="container">
            <div class="row mt-20 mb-20">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 mt-10">
                        <div class="row">

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

                            <input type="hidden" name="id" value="{{ $supplier->id }}">


                            <input type="hidden" name="whattodo" id="whattodo" value="update">
                            <input type="hidden" name="savestep" id="savestep" value="0">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name:" value="{{ !empty($supplier->first_name) ? $supplier->first_name : old('first_name') }}">
                            @if ($errors->has('first_name'))
                            <span class="inputError">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name:" value="{{ !empty($supplier->last_name) ? $supplier->last_name : old('last_name') }}">
                            @if ($errors->has('last_name'))
                            <span class="inputError">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">


                            <select name="company_id" id="company_id" onchange="supplier_user(this.value);">
                                <option value="">Select Company</option>
                                @foreach( $company as $role )
                                <option  value="{{ $role['id'] }}" {{ isset($supplier)?($supplier->company_id == $role['id'] ? 'selected' : ''):('') }} >{{ $role['business_name'] }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('company_id'))
                            <span class="inputError">{{ $errors->first('company_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">


                            <select name="user_parent_id" id="user_parent_id">
                                <option value="">Select Supplier User</option>
                                @foreach( $supplier_admin as $role )
                                <option  value="{{ $role['id'] }}" {{ isset($supplier)?($supplier->user_parent_id == $role['id'] ? 'selected' : ''):('') }}>{{ $role['first_name'] }}  {{ $role['last_name'] }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('user_parent_id'))
                            <span class="inputError">{{ $errors->first('user_parent_id') }}</span>
                            @endif
                        </div>



                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="business_tel_number" id="business_tel_number" placeholder="Business Telephone No:" value="{{ !empty($supplier->business_tel_number) ? $supplier->business_tel_number : old('business_tel_number') }}">
                            @if ($errors->has('business_tel_number'))
                            <span class="inputError">{{ $errors->first('business_tel_number') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="position" id="position" placeholder="Position :" value="{{ !empty($supplier->position) ? $supplier->position : old('position') }}">
                            @if ($errors->has('position'))
                            <span class="inputError">{{ $errors->first('position') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="business_address_line_1" id="business_address_line_1" placeholder="Business Address:" value="{{ !empty($supplier->business_address_line_1) ? $supplier->business_address_line_1 : old('business_address_line_1') }}">
                            @if ($errors->has('business_address_line_1'))
                            <span class="inputError">{{ $errors->first('business_address_line_1') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="business_address_line_2" id="business_address_line_2" placeholder="Business Address(field 2):" value="{{ !empty($supplier->business_address_line_2) ? $supplier->business_address_line_2 : old('business_address_line_2') }}">
                            @if ($errors->has('business_address_line_2'))
                            <span class="inputError">{{ $errors->first('business_address_line_2') }}</span>
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
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile No:" value="{{ !empty($supplier->mobile_number) ? $supplier->mobile_number : old('mobile_number') }}">
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

                    <div class="col-md-1">&nbsp;</div>

                </div>
            </div>
            <div class="row"> 
                <div class="col-md-offset-2 col-md-8 text-center mt-30 mb-20">
                    <button class="btn btn-dark btn-pad selected" type="submit"> Save Changes</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <a href="{{ url('/supplier-company-list') }}" ><button class="btn btn-dark btn-block" type="button"> EDIT SUPPLIER DETAILS* </button></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <a href="{{ url('/supplieruserlist') }}"><button class="btn btn-dark btn-block" type="button"> EDIT USERS & PERMISSIONS* </button></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a href="{{ url('/supplier-brand-list') }}"><button class="btn btn-dark btn-block" type="button"> EDIT BRAND(S)</button></a>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>

        </div>
    </div>
</form>
<div class="footer">
    <div class="conatiner text-center">
        <div class="">
            <div class="col-md-1 col-sm-1">&nbsp;</div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
{{--  <div class="row">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
<button class="btn btn-default btn-block"> + ADD NEW SUPPLIER</button>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
<button class="btn btn-default btn-block"> + ADD A NEW USER</button>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<button class="btn btn-default btn-block"> +ADD A NEW BRAND</button>
</div>
</div> --}}
<a href="{{ url('/supplier-company-add') }}"><button class="btn btn-default spbtn" type="button"> + ADD NEW SUPPLIER</button></a>
<a href="{{ url('/add-new-user') }}"> <button class="btn btn-default spbtn m-l-20" type="button"> + ADD A NEW USER</button></a>
<a href="{{ url('/add-new-brand') }}"><button class="btn btn-default spbtn m-l-20" type="button"> + ADD A NEW BRAND</button></a>
</div>
<div class="col-md-1 col-sm-1">&nbsp;</div>
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
$('#business_tel_number').val('');
$('#business_address_line_1').val('');
$('#business_address_line_2').val('');
$('#user_role').val('');
$('#mobile_number').val('');
$('#email').val('').removeAttr('readonly');
$('#password').val('').removeAttr('readonly');
$('#whattodo').val('new');
});

        $('#viewexistinguser').on('click', function(e) {
            var spid = $('#supplier_parent_id').val();
            var company_id = $('#company_id').val();
            var html = '';
            if( spid != undefined ) {


                $.ajax({
                    type: "GET",
                    url: "<?php echo url('/get_list_of_supplier')?>/"+company_id,
                    success: function(data) {  

// alert("hii");
console.log(data);
$('#supplier_list').append(data);
},

})





            } else {
                html += '<p>No User Found</p>';
            }
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

    function supplier_user(id) {
// body...
if (id) {

    $.ajax({

        type:"GET",
        url:"<?php echo url('/get_supplier_company')?>/"+id,
        success: function(data) {  


            $('#user_parent_id').html(data);
        },
    });

}else{

    $('#user_parent_id').html('<option value="">Select Supplier User</option>');
} 

}
</script>
@endsection