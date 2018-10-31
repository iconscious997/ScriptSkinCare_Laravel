@extends('layouts.master')
@section('content')
<form action="{{ url('/usersupplierstore') }}" method="POST" id="first">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">ADD NEW SUPPLIER</h3>
            </div>
        </div>
    </div>
    <div class="content-fix">
        <div class="container">
            <div class="row mt-20 mb-20">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-md-6">
                        <div class="row">
                            
                        </div>
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
                            @if ( !empty($supplier) )
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                            @endif
                            @if ( Session::has('supplier_parent_id') )
                            <input type="hidden" name="supplier_parent_id" id="supplier_parent_id" value="{{ Session::get('supplier_parent_id') }}">
                            @endif

                          
                            {{-- Session::put('supplier_parent_id', Session::get('second')); --}}
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


                            <select name="company_id" id="company_id">
                                <option value="">Select Compnay</option>
                                @foreach( $company as $role )
                                <option  value="{{ $role['id'] }}" >{{ $role['business_name'] }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('company_id'))
                            <span class="inputError">{{ $errors->first('company_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="business_tel_number" id="business_tel_number" placeholder="Business Telephone No:" value="{{ !empty($supplier->business_tel_number) ? $supplier->business_tel_number : old('business_tel_number') }}">
                            @if ($errors->has('business_tel_number'))
                            <span class="inputError">{{ $errors->first('business_tel_number') }}</span>
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
                        
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile No:" value="{{ !empty($supplier->mobile_number) ? $supplier->mobile_number : old('mobile_number') }}">
                            @if ($errors->has('mobile_number'))
                            <span class="inputError">{{ $errors->first('mobile_number') }}</span>
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
                <div class="col-md-1">&nbsp;</div>

                <div class="col-md-10 text-center mt-30 mb-10">
                    <button class="btn btn-dark btn-pad selected" type="button" id="btnsavestep"> SAVE CHANGES </button>
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
                <a href="{{ url('/supplier-company-add') }}" ><button type="button" class="btn btn-default spbtn active"> + ADD NEW SUPPLIER</button></a>
                   
               <a href="{{ url('/add-new-user') }}" > <button type="button" class="btn btn-default spbtn m-l-20"> + ADD A NEW USER</button></a>
              
                <a href="{{ url('/add-new-brand') }}"><button type="button" class="btn btn-default spbtn m-l-20"> + ADD A NEW BRAND</button></a>

                
            </div>
            <div class="col-md-1 col-sm-1">&nbsp;</div>
        </div>
    </div>
</div>

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

       
    });
</script>
@endsection