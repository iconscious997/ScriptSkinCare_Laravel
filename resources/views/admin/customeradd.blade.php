@extends('layouts.master')
@section('content')
<form action="{{ url('/customerstore') }}" method="POST" id="first">
    @csrf
    @if ( !empty($customer) )
    <input type="hidden" name="id" value="{{ $customer->id }}">
    @endif

    <div class="wizard mb-20">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Edit Users & Permissions</h3>
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
                            <h4 class="bold-700">Customer Information:</h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-10">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 p-r-0 ">
                                <a href="{{ url('/customers') }}"><button class="btn btn-green selected btn-block font11" type="button" id="viewexistinguser"> VIEW / EDIT EXISTING CUSTOMER</button></a>

                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 p-l-0">
                                <a href="{{ url('/customeradd') }}"><button class="btn btn-green selected btn-block m-l-15 font11" type="button" id="addadditionaluser"> + ADD ADDITIONAL CUSTOMER</button></a>
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
                            <input type="text" class="form-control" name="first_name" placeholder="First Name:" value="{{ !empty($customer->first_name) ? $customer->first_name : old('first_name') }}">
                            @if ($errors->has('first_name'))
                            <span class="inputError">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                         <input type="text" class="form-control" name="last_name" placeholder="Last Name:" value="{{ !empty($customer->last_name) ? $customer->last_name : old('last_name') }}">
                         @if ($errors->has('last_name'))
                         <span class="inputError">{{ $errors->first('last_name') }}</span>
                         @endif
                     </div>
                 </div>
                 <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control datepicker" name="dob" placeholder="Date of Birth:" readonly value="{{ !empty($customer->dob) ? date('m/d/Y',strtotime($customer->dob)) : old('dob') }}">
                        @if ($errors->has('dob'))
                        <span class="inputError">{{ $errors->first('dob') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        @php $selected_gender = old('gender') @endphp
                        @if( !empty($customer->gender) ) 
                        @php $selected_gender = $customer->gender; @endphp
                        @endif
                        <select class="" name="gender">
                            <option value="">Gender</option>
                            <option value="Male" {{ $selected_gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $selected_gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @if ($errors->has('gender'))
                        <span class="inputError">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="email" placeholder="Email:" value="{{ !empty($customer->email) ? $customer->email : old('email') }}" {{ !empty($customer->email) ? 'readonly' : '' }}>
                        @if ($errors->has('email'))
                        <span class="inputError">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                       <input type="text" class="form-control" name="signup_source" placeholder="Sign-Up Source:" value="{{ !empty($customer->signup_source) ? $customer->signup_source : old('signup_source') }}">
                       @if ($errors->has('signup_source'))
                       <span class="inputError">{{ $errors->first('signup_source') }}</span>
                       @endif
                   </div>
               </div>
               <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control datepicker" name="created_date" placeholder="Registered Date:" readonly value="{{ !empty($customer->created_date) ? date('m/d/Y',strtotime($customer->created_date)) : old('created_date') }}">
                    @if ($errors->has('created_date'))
                    <span class="inputError">{{ $errors->first('created_date') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">                    
                     <select name="created_by" id="created_by">
                        <option value="">Registered By:</option>
                        @foreach( $user_admin_retailer as $users )
                        <option  value="{{ $users['userid'] }}" {{ !empty($customer)?($customer->created_by == $users['userid'] ? 'selected' : ''):('') }}>{{ $users['name'] }} </option>

                        @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" name="created_by" placeholder="Registered By:" value="{{ !empty($customer->created_by) ? $customer->created_by : old('created_by') }}"> -->
                    @if ($errors->has('created_by'))
                    <span class="inputError">{{ $errors->first('created_by') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
             <div class="form-group col-md-6">
                 <input type="text" class="form-control" name="skin_concerns" placeholder="Most Recent Skin Concern:" value="{{ !empty($customer->skin_concerns) ? $customer->skin_concerns : old('skin_concerns') }}">
                 @if ($errors->has('skin_concerns'))
                 <span class="inputError">{{ $errors->first('skin_concerns') }}</span>
                 @endif
             </div>
             <div class="form-group col-md-6">
                <input type="text" class="form-control" name="skin_type" placeholder="Most Recent Skin Type:" value="{{ !empty($customer->skin_type) ? $customer->skin_type : old('skin_type') }}">
                @if ($errors->has('skin_type'))
                <span class="inputError">{{ $errors->first('skin_type') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
</div>

<div class="row">
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-10 text-center mt-60 mb-30">
        <div class="button-checkbox">
            <button type="button" class="btn" data-color="primary">MANUALLY ASSIGN FULL SKIN ASSESSMENT</button>
            <input type="checkbox" value="1" name="manual_skin_assessment" class="hidden" {{ !empty($customer->manual_skin_assessment) == '1' ? 'checked' : '' }} />
        </div>
        <button class="btn btn-default"> SAVE CHANGES</button><br>
    </div>
    <div class="col-md-1">&nbsp;</div>
</div>
</div>
</div>
<div class="footer">
    <div class="conatiner text-center">
        <div class="row">
            <div class="col-md-1 col-sm-1">&nbsp;</div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">                
                 <a href="{{ url('/user-supplier-add') }}"><button class="btn btn-default spbtn2" type="button"> + ADD NEW SUPPLIER</button></a>
                 <a href="{{ url('/add-new-user') }}"><button class="btn btn-default spbtn2 m-l-20" type="button"> + ADD A NEW USER</button></a>
                 <a href="{{ url('/add-new-brand') }}"><button class="btn btn-default spbtn2 m-l-20" type="button"> + ADD A NEW BRAND</button></a>
            </div>
            <div class="col-md-1 col-sm-1">&nbsp;</div>
        </div>
    </div>
</div>
</form>
@endsection