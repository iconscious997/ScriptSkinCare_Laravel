@extends('supplier.suppliermaster')
@section('content')

<form action="{{ url('/companystore') }}" method="POST" >
    @csrf

    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">MANAGE COMPANY</h3>
            </div>
        </div>
    </div>

    <div class="content-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="clearfix">&nbsp;</div>
                    <h4 class="bold-700 font17 mb-5">Edit Company Details:</h4>
                    <div class="clearfix">&nbsp;</div>
                    <div class="form-group">
                        @if ( !empty($company) )
                        <input type="hidden" name="id" value="{{ $company->id }}">
                        @endif
                        <input type="text" class="form-control" name="registered_business_name" id="registered_business_name" placeholder="Registered Business Name:" value="{{ !empty($company->business_name) ? $company->business_name : old('registered_business_name') }}">
                        @if ($errors->has('registered_business_name'))
                        <span class="inputError">{{ $errors->first('registered_business_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="trading_name" id="trading_name" placeholder="Trading Name:" value="{{ !empty($company->trading_name) ? $company->trading_name : old('trading_name') }}">
                        @if ($errors->has('trading_name'))
                        <span class="inputError">{{ $errors->first('trading_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="abn" id="abn" placeholder="ABN:" value="{{ !empty($company->abn) ? $company->abn : old('abn') }}">
                        @if ($errors->has('abn'))
                        <span class="inputError">{{ $errors->first('abn') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address:" value="{{ !empty($company->address) ? $company->address : old('address') }}">
                        @if ($errors->has('address'))
                        <span class="inputError">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="business_telephone" id="business_telephone" placeholder="Business Telephone:" value="{{ !empty($company->business_telephone_number) ? $company->business_telephone_number : old('business_telephone') }}" onkeypress="return isNumberKey(event)">
                        @if ($errors->has('business_telephone'))
                        <span class="inputError">{{ $errors->first('business_telephone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Email Address:" value="{{ !empty($company->email_address) ? $company->email_address : old('email_address') }}">
                        @if ($errors->has('email_address'))
                        <span class="inputError">{{ $errors->first('email_address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="website" id="website" placeholder="Website:" value="{{ !empty($company->website) ? $company->website : old('website') }}">
                        @if ($errors->has('website'))
                        <span class="inputError">{{ $errors->first('website') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
            <div class="clearfix">&nbsp;</div>

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
                        <a href="{{ url('/user-supplier-add') }}" ><button class="btn btn-default btn-block" type="button"> + ADD NEW PRODUCT</button></a>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                       <a href="{{ url('/add-new-user') }}"><button class="btn btn-default btn-block" type="button"> + ADD NEW COMPANY</button></a>
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