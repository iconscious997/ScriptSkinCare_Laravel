@extends('layouts.master')
<style>
.tab,.tab1 {
	display: none;
}
</style>
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
	                <span class="inputError" id="trading_name_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="abn" id="abn" placeholder="ABN:">
	                <span class="inputError" id="abn_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="address" id="address" placeholder="Address:">
	                <span class="inputError" id="address_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="business_telephone" id="business_telephone" placeholder="Business Telephone:">
	                <span class="inputError" id="business_telephone_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Email Address:">
	                <span class="inputError" id="email_address_span"></span>
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="website" id="website" placeholder="Website:">
	                <span class="inputError" id="website_span"></span>
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
                        <input type="text" class="form-control" name="" placeholder="Supplier:">
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
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
window.addEventListener('load', function() {
	showTab(currentTab); // Display the current tab
});
function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  var x1 = document.getElementsByClassName("tab1");
  // console.log(x);
  x[n].style.display = "block";
  x1[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "SUBMIT";
  } else {
    document.getElementById("nextBtn").innerHTML = 'NEXT &nbsp;<i class="ti-arrow-right"></i>';
  }
  
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n);
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  var x1 = document.getElementsByClassName("tab1");
  // Exit the function if any field in the current tab is invalid:
  // if (n == 1 && !validateForm()) return false;
  // if validation goes well then submit the form with ajax
  // console.log(n);
	$.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="_mytoken"]').attr('content')
    	}
	});
  if(n == -1) {
  	// here previous button is clicked
  	console.log(x[currentTab - 1].id);
  } else {
  	// here next button is clicked
  	var mytab = x[currentTab].id;
  	switch (mytab) {
  		case 'first':
  			// submit the first tab data
  			$.ajax({
  				url: "{{ url('/supplierstep1') }}",
  				method: "POST",
  				dataType: "JSON",
  				async: false,
  				data: {
  					registered_business_name: $('#registered_business_name').val(),
  					trading_name: $('#trading_name').val(),
  					abn: $('#abn').val(),
  					address: $('#address').val(),
  					business_telephone: $('#business_telephone').val(),
  					email_address: $('#email_address').val(),
  					website: $('#website').val()
  				},
  				success: function(res) {
  					console.log(res);
  					if(res.error == 1) {
  						if(res.msg == 'validate') {
  							$.each(res.data.errors, function(key, value){
  								$('#'+key).addClass('inputField');
                  				$('#'+key+'_span').text(value);
                  			});
                  			return false;
  						}
  					} else {
  						// Hide the current tab:
					  	x[currentTab].style.display = "none";
					  	x1[currentTab].style.display = "none";
					  	// Increase or decrease the current tab by 1:
					  	currentTab = currentTab + n;
					  	// if you have reached the end of the form...
					  	if (currentTab >= x.length) {
					    	// ... the form gets submitted:
					    	document.getElementById("regForm").submit();
					    	return false;
					  	}
					  	// Otherwise, display the correct tab:
					  	showTab(currentTab);
  					}
  				}
  			}); // end ajax call
  			break;
  		default:
  			// statements_def
  			break;
  	}
  	console.log(x[currentTab].id);
  }
  // // Hide the current tab:
  // x[currentTab].style.display = "none";
  // x1[currentTab].style.display = "none";
  // // Increase or decrease the current tab by 1:
  // currentTab = currentTab + n;
  // // if you have reached the end of the form...
  // if (currentTab >= x.length) {
  //   // ... the form gets submitted:
  //   document.getElementById("regForm").submit();
  //   return false;
  // }
  // // Otherwise, display the correct tab:
  // showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " inputField";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("page-item")[currentTab].className += " active";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("page-item");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>