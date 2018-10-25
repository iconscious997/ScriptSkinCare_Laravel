@extends('supplier.suppliermaster')
@section('content')
<form action="{{ route('supplierproductlineadd') }}" method="POST" id="first" enctype="multipart/form-data">
    @csrf
    <div class="wizard bg3">
        <div class="container">
            <div class="row">
                <h3 class="text-center">ADD NEW PRODUCT LINE</h3>
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
                        <select name="brand_id" id="brand_id">
                            <option value="">Select Brand</option>
                            @foreach( $brands as $brand )
                            <option  value="{{ $brand['id'] }}" >{{ $brand['brand_name'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                        <span class="inputError">{{ $errors->first('brand_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="productline_name" value="{{ old('productline_name') }}" id="productline_name" placeholder="Product Line Name:">
                        @if ($errors->has('productline_name'))
                        <span class="inputError">{{ $errors->first('productline_name') }}</span>
                        @endif
                    </div>

                </div>

                <div class="col-md-3">&nbsp;</div>
            </div>
            <div class="clearfix">&nbsp;</div>


            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center mt-30 mb-40">
                    <button class="btn btn-dark btn-pad selected" type="submit">Save CHANGES</button>
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
                        <a href="{{ url('/user-supplier-add') }}"><button class="btn btn-default btn-block" type="button"> + ADD NEW PRODUCT</button></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <a href="{{ url('/add-new-user') }}"><button class="btn btn-default btn-block" type="button"> + ADD NEW COMPANY</button></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a href="{{ route('supplierbrandadd') }}"><button class="btn btn-default btn-block" type="button"> + ADD NEW BRAND</button></a>

                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">&nbsp;</div>
        </div>
    </div>
</div>
@endsection