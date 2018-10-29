@extends('layouts.master')
@section('content')
<form action="{{ url('/addnewbrandstore') }}" method="POST" id="first" enctype="multipart/form-data">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">ADD A NEW BRAND</h3>
            </div>
        </div>
    </div>

    <div class="content-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="clearfix">&nbsp;</div>
                    
                    <div class="clearfix">&nbsp;</div>
                   
                    <div class="form-group">
                        <input type="text" class="form-control" name="brand_name" value="{{ !empty($brands_data->brand_name) ? $brands_data->brand_name : old('brand_name') }}"
                        id="brand_name" placeholder="Brand Name:">
                        @if ($errors->has('brand_name'))
                        <span class="inputError">{{ $errors->first('brand_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
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
                    
                  
                <div class="form-group">
                    <div class="upload-btn-wrapper">
                        <button class="form-control text-left">Upload Logo: (Height: 50px and Width: 200px</button>
                        <div class="inner-addon right-addon">
                         <i class="ti-plus"></i>
                         <input type="file" name="brand_logo" id="brand_logo" />
                         @if ($errors->has('brand_logo'))
                         <span class="inputError">{{ $errors->first('brand_logo') }}</span>
                         @endif
                     </div>
                 </div>
             </div>
             
                  
        </div>


        
        <div class="col-md-3">&nbsp;</div>
    </div>
    <div class="clearfix">&nbsp;</div>
   

 <div class="row">
    <div class="col-md-offset-2 col-md-8 text-center mt-30 mb-40">
        <button class="btn btn-dark btn-pad selected" type="submit">SAVE CHANGES</button>
    </div>
</div>
</div>
</div>

</form>
<div class="footer">
    <div class="conatiner text-center">
        <div class="">
            <div class="col-md-1 col-sm-1">&nbsp;</div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <a href="{{ url('/supplier-company-add') }}"><button class="btn btn-default spbtn" type="button"> + ADD NEW SUPPLIER</button></a>
                   

                   
                <a href="{{ url('/add-new-user') }}"><button class="btn btn-default spbtn m-l-20 " type="button"> + ADD A NEW USER</button></a>
                <a href="{{ url('/add-new-brand') }}">
                <button class="btn btn-default spbtn m-l-20 active" type="button"> + ADD A NEW BRAND</button></a>
            </div>
            <div class="col-md-1 col-sm-1">&nbsp;</div>
        </div>
    </div>
</div>


@endsection