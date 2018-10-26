@extends('layouts.master')
@section('content')
<form action="{{ url('/newretailuserstore') }}" method="POST" id="first">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">ADD RETAIL USER</h3>
            </div>
        </div>
    </div>
    <div class="content-fix wow fadeIn" data-wow-duration="2s" >
        <div class="container">
            <div class="row mt-20 mb-20">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                   
                    <div class="col-md-6 mt-10">
                       
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="form-group col-md-6">
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
                                @foreach($roles as $role )
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


                            <select name="clinic_id" id="clinic_id">
                                <option value="">Select Clinic </option>
                                @foreach( $retailsite as $role )
                                <option  value="{{ $role['id'] }}">{{ $role['clinic_name'] }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('clinic_id'))
                            <span class="inputError">{{ $errors->first('clinic_id') }}</span>
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
       
        <div class="row">
            <div class="col-md-1">&nbsp;</div>

            <div class="col-md-10 text-center mt-30 mb-10">
                <button class="btn btn-dark btn-pad" type="button" id="btnsavestep">  Save Changes </button>
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

                <a href="{{ url('/new-retail-user') }}" > <button type="button" class="btn btn-default ripple spbtn m-l-20 active"> + ADD A NEW USER</button></a>

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

       
    });
</script>
@endsection