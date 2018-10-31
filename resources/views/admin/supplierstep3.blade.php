@extends('layouts.master')
@section('content')
<form action="{{ url('/supplierstep3store') }}" method="POST" id="first" enctype="multipart/form-data">
    @csrf
    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Step 3: Add A New Brand</h3>
            </div>
        </div>
    </div>

    <div class="content-fix wow fadeIn" data-wow-duration="2s">
        <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="clearfix">&nbsp;</div>
                    <h4 class="bold-600 mb-10">Add A New Brand</h4>
                    <div class="clearfix">&nbsp;</div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="brand_name" value="{{ !empty($brands_data->brand_name) ? $brands_data->brand_name : old('brand_name') }}"
                        id="brand_name" placeholder="Brand Name:">
                        @if ($errors->has('brand_name'))
                        <span class="inputError">{{ $errors->first('brand_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class=""  title="Supplier" name="supplier_parent_id" id="supplier_parent_id">
                            @foreach($supplier as $item)
                            <option value="{{$item['id']}}" {{ (Session::get('parent_id') == $item['id'] ? 'selected' : '') }} {{ (isset($brands_data->supplier_parent_id)?$brands_data->supplier_parent_id == $item['id'] ? 'selected' : '':'') }} >{{$item['first_name']}} {{$item['last_name']}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <select title="Added By" class="" id="created_by" name="created_by">
                            <option value="" disabled selected>Added By</option>
                            @foreach($supplier as $item)
                            <option value="{{$item['id']}}" {{ (isset($brands_data->user_added_by)?$brands_data->user_added_by == $item['id'] ? 'selected' : '':'') }}>{{$item['first_name']}} {{$item['last_name']}}</option>
                            @endforeach 
                        </select>
                        @if ($errors->has('created_by'))
                        <span class="inputError">{{ $errors->first('created_by') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="sm-select" title="Assign To User" name="assign_to_user[]" multiple="multiple" id="assign_to_user">
                          <?php 
                          if (isset($update_supplier)) {

                            foreach ($sub_supplier as $item) {
                                echo '<option value="'.$item->id.'" '.(in_array($item->id,$update_supplier)?'selected':'').'  >'.$item->first_name.' '.$item->last_name.'</option>';
                            }
                        }else{

                            foreach ($sub_supplier as $item) {

                                echo '<option value="'.$item->id.'" >'.$item->first_name.' '.$item->last_name.'</option>';
                            }
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
        <input type="hidden" name="savestep" id="savestep" value="0">   
        @if (isset($brand_id))
        <input type="hidden"   value="update" name="check_data">
        <input type="hidden" name="id" value="{{ $brands_data->id }}">
        <input type="hidden" name="old_image_name" value="{{ $brands_data->brand_logo }}">
        @endif
        <div class="col-md-3">&nbsp;</div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">.
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8 text-center">
            <hr>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15">
                    <a href="{{ route('supplierstep2') }}" class="prev m-l-30" id="prevBtn"><i class="ti-arrow-left"></i> &nbsp;PREVIOUS</a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <ul class="pagination pagination-split">
                        <li class="page-item "><span class="page-link">1</span></li>
                        <li class="page-item "><span class="page-link">2</span></li>
                        <li class="page-item active"><span class="page-link">3</span></li>
                        <li class="page-item"><span class="page-link">4</span></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right mt-15">
                   <a onclick="javascript:$('#first').submit();" class="next" id="nextBtn">NEXT &nbsp;<i class="ti-arrow-right"></i></a>

               </div>
           </div>
           <hr>
       </div>
       <div class="col-md-2">&nbsp;</div>
   </div>

   <div class="row">
    <div class="col-md-offset-2 col-md-8 text-center mt-30 mb-40">
        <button class="btn btn-dark btn-pad selected" type="submit" id="btnsavestep"> SAVE STEP 3 & ACTIVATE</button>
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
                     <a href="{{ url('/supplier-company-add') }}" > <button type="button" class="btn btn-default btn-block"> + ADD NEW SUPPLIER</button></a>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                     <a href="{{ url('/add-new-user') }}" >  <button type="button" class="btn btn-default btn-block"> + ADD A NEW USER</button></a>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="{{ url('/add-new-brand') }}"><button type="button" class="btn btn-default btn-block"> +ADD A NEW BRAND</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">&nbsp;</div>
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
    });
</script>
@endsection