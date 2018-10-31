@extends('supplier.suppliermaster')
@section('content')

<form action="{{ url('/supplier/usereditstore') }}" method="POST" id="first">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">EDIT USERS</h3>
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


                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="company Name:" value="{{Session::get('company_name')}}" readonly="">
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

           

        </div>
    </div>
</form>

<div class="footer">
    <div class="conatiner text-center">
        <div class="row">
            <div class="col-md-2 col-sm-2">&nbsp;</div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <a href="{{ route('supplierbrandadd') }}" ><button class="btn btn-default btn-block" type="button"> + ADD NEW BRAND</button></a>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                       <a href="{{ route('supplieruseradd') }}"><button class="btn btn-default btn-block" type="button"> + ADD NEW USER</button></a>
                   </div>
                   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="{{ route('supplierproductlineadd') }}"> <button class="btn btn-default btn-block" type="button"> + ADD NEW PRODUCT LINE</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">&nbsp;</div>
    </div>
</div>
</div>

@endsection