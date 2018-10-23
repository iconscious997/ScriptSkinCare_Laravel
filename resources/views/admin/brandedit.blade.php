@extends('layouts.master')
@section('content')
<form action="{{ url('/brandstore') }}" method="POST" id="first" enctype="multipart/form-data">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">EDIT BRAND</h3>
            </div>
        </div>
    </div>

    <div class="content-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="clearfix">&nbsp;</div>
                    <h4 class="bold-600 mb-10">Edit Brand</h4>
                    <div class="clearfix">&nbsp;</div>
                   
                    <div class="form-group">
                        <input type="text" class="form-control" name="brand_name" value="{{ !empty($brands_data->brand_name) ? $brands_data->brand_name : old('brand_name') }}"
                        id="brand_name" placeholder="Brand Name:">
                        @if ($errors->has('brand_name'))
                        <span class="inputError">{{ $errors->first('brand_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="" title="Supplier" name="supplier_parent_id" id="supplier_parent_id">
                            @foreach($supplier as $item)
                            <option value="{{$item['id']}}" {{ (isset($brands_data->supplier_parent_id)?$brands_data->supplier_parent_id == $item['id'] ? 'selected' : '':'') }} >{{$item['first_name']}} {{$item['last_name']}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <select title="Added By" class="" id="created_by" name="created_by" plac>
                            <option value="" disabled selected>Added By</option>
                            @foreach($supplier as $item)
                            <option value="{{$item['id']}}" {{ (isset($brands_data->user_added_by)?$brands_data->user_added_by == $item['id'] ? 'selected' : '':'') }} >{{$item['first_name']}} {{$item['first_name']}}</option>
                            @endforeach 
                        </select>
                        @if ($errors->has('created_by'))
                        <span class="inputError">{{ $errors->first('created_by') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="sm-select" title="Assign To User" name="assign_to_user[]" multiple="multiple" id="assign_to_user">
                          <?php 
                       

                            foreach ($sub_supplier as $item) {
                                echo '<option value="'.$item->id.'" '.(isset($update_supplier)?(in_array($item->id,$update_supplier)?'selected':''):'').'  >'.$item->first_name.' '.$item->last_name.'</option>';
                            }
                       
                        ?>

                    </select>
                    @if ($errors->has('assign_to_user'))
                    <span class="inputError">{{ $errors->first('assign_to_user') }}</span>
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
             <div class="form-group">
                <select class="" title="Approved By" name="approved_by" id="approved_by">
                    <option value="" disabled selected>Approved By</option>
                    @foreach($supplier as $item)
                    <option value="{{$item['id']}}" {{ (isset($brands_data->approved_by)?$brands_data->approved_by == $item['id'] ? 'selected' : '':'') }} >{{$item['first_name']}} {{$item['last_name']}}</option>
                    @endforeach 


                </select>
                @if ($errors->has('approved_by'))
                <span class="inputError">{{ $errors->first('approved_by') }}</span>
                @endif
            </div>
                  
        </div>

        
        <input type="hidden" name="id" value="{{ $brands_data->id }}">
        <input type="hidden" name="old_image_name" value="{{ $brands_data->brand_logo }}">
        
        <div class="col-md-3">&nbsp;</div>
    </div>
    <div class="clearfix">&nbsp;</div>
   

 <div class="row">
    <div class="col-md-offset-2 col-md-8 text-center mt-30 mb-40">
        <button class="btn btn-dark btn-pad selected" type="submit"> Update</button>
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
                        <a href="{{ url('/user-supplier-add') }}" ><button class="btn btn-light btn-block" type="button"> + ADD NEW SUPPLIER</button></a>
                           
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                         <a href="{{ url('/add-new-user') }}"><button class="btn btn-light btn-block" type="button"> + ADD A NEW USER</button></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a href="{{ url('/add-new-brand') }}"> <button class="btn btn-light btn-block" type="button"> +ADD A NEW BRAND</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">&nbsp;</div>
        </div>
    </div>
</div>


@endsection