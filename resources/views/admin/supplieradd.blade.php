@extends('layouts.master')
@section('content')
<div class="alert alert-danger" style="display:none"></div>
<div class="tab" id="first">
	<div class="wizard">
	    <div class="container">
	        <div class="row">
	            <h3 class="text-center">STEP ONE:COMPANY DETAILS*</h3>
	        </div>
	    </div>
	</div>
	<div class="container">
		<div class="row">
	        <div class="col-md-offset-3 col-md-7">
	            <h4 class="bold-600">Please Enter New Company Details</h4>
	            <div class="clearfix">&nbsp;</div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="registered_business_name" id="registered_business_name" placeholder="Registered Business Name:">
	                <span class="inputError" id="registered_business_name_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:">
	                @if ($errors->has('trading_name'))
	                	<span class="inputError">{{ $errors->first('trading_name') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="abn" id="abn" placeholder="ABN:">
	                @if ($errors->has('abn'))
	                	<span class="inputError">{{ $errors->first('abn') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="address" id="address" placeholder="Address:">
	                @if ($errors->has('address'))
	                	<span class="inputError">{{ $errors->first('address') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="business_telephone" id="business_telephone" placeholder="Business Telephone:">
	                @if ($errors->has('business_telephone'))
	                	<span class="inputError">{{ $errors->first('business_telephone') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Email Address:">
	                @if ($errors->has('email_address'))
	                	<span class="inputError">{{ $errors->first('email_address') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="website" id="website" placeholder="Website:">
	                @if ($errors->has('website'))
	                	<span class="inputError">{{ $errors->first('website') }}</span>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
</div>
<div class="tab" id="second">
	<div class="wizard mb-20">
        <div class="container">
            <div class="row">
                <h3 class="text-center">STEP 2: SET-UP USERS & PERMISSIONS*</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <div class="col-md-6">
                    <h4 class="bold-600">Set-Up Users & Permissions:</h4>

                    <div class="clearfix">&nbsp;</div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="First Name:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Suppiler:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Business Address:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="User Role:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Email Address:">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-green selected"> VIEW / EDIT EXISTING USERS</button>

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-green selected"> + ADD ADDITIONAL USER</button>
                        </div>
                    </div>
                    <div class="clearfix mb-10">&nbsp;&nbsp;</div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Last Name:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Business Telephone No:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Business Address(field 2):">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Mobile No:">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Password:">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab" id="third">
	<div class="wizard mb-20">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Step 3: Add A New Brand</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-7">
                <h4 class="bold-600">Add A New Brand</h4>
                <div class="clearfix">&nbsp;</div>
                <div class="form-group">
                    <input type="text" class="form-control inputField" name="" placeholder="Brand Name:">
                </div>
                <div class="form-group">
                    <select class="">
                        <option>Supplier: (Auto-Filled - Can be Changed To Another Supplier On Acivated)</option>
                        <option>1</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="" placeholder="Added By:">
                </div>
                <div class="form-group">
                    <select name="test" aria-invalid="false">
                      <option>Assign To User:</option>
                      <option>1</option>
                  	</select>
              	</div>
                <div class="form-group">
	                <div class="upload-btn-wrapper">
	                    <button class="form-control text-left">Upload Logo: (Height: 50px and Width: 200px</button>
	                    <div class="inner-addon right-addon">
	                     <i class="ti-plus"></i>
	                     <input type="file" name="myfile" />
	                    </div>
	                </div>
	            </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="" placeholder="Approved By:">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab" id="fourth">
	<div class="wizard mb-20">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Step 4: Review & Acivate</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-9">
                <h4 class="bold-600">Review All Information:</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="company">
                            <h4>Company Details</h4>
                        </div>
                        <div class="text-center mt-20">
                            <button class="btn btn-dark selected"> EDIT</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="company">
                            <h4>User Profile</h4>
                        </div>
                        <div class="text-center mt-20">
                            <button class="btn btn-dark selected"> EDIT</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="company">
                        </div>
                        <div class="text-center mt-20">
                            <button class="btn btn-dark selected"> ADD A BRAND (AUTO-ACTIVATE)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-md-offset-2 col-md-9 text-center">
            <hr>
            <div class="row">
                <div class="col-md-2 mt-15">
                    <a href="javascript:void(0)" class="prev" id="prevBtn" onclick="nextPrev(-1)"><i class="ti-arrow-left"></i> &nbsp;PREVIOUS</a>
                </div>
                <div class="col-md-8">
                    <ul class="pagination pagination-split">
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mt-15">
                    <a href="javascript:void(0)" class="next" id="nextBtn" onclick="nextPrev(1)">NEXT &nbsp;<i class="ti-arrow-right"></i></a>

                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="tab1">
    	<div class="row">
            <div class="col-md-offset-2 col-md-9 text-center mt-30 mb-40">
                <button class="btn btn-dark selected"> SAVE STEP1</button>
            </div>
        </div>
    </div>
    <div class="tab1">
    	<div class="row">
            <div class="col-md-offset-2 col-md-9 text-center mt-30 mb-40">
                <button class="btn btn-dark selected"> SAVE STEP 2 & ACTIVATE USER PROFILE</button>
            </div>
        </div>
    </div>
    <div class="tab1">
    	<div class="row">
            <div class="col-md-offset-2 col-md-9 text-center mt-30 mb-40">
                <button class="btn btn-dark selected"> SAVE STEP 3 & ACTIVATE</button>
            </div>
        </div>
    </div>
    <div class="tab1">
    	<div class="row">
            <div class="col-md-offset-2 col-md-9 text-center mt-30 mb-40">
                <button class="btn btn-dark selected"> ACTIVATE SUPPLIER PROFILE</button>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="conatiner">
        <div class="row">
            <div class="col-md-offset-2 col-md-9 text-center">
                <div class="col-md-4">
                    <button class="btn btn-light"> + ADD NEW SUPPLIER</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-light"> + ADD A NEW USER</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-light"> +ADD A NEW BRAND</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection