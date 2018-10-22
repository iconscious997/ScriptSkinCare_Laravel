@extends('layouts.master')
@section('content')

<form action="{{ url('/supplierstep4store') }}" method="POST" id="first">
    @csrf

    <div class="wizard">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Step 4: Review & Activate</h3>
            </div>
        </div>
    </div>

    <div class="content-fix">
        <div class="container">

            <div class="row mt-20 mb-20">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <h4 class="bold-700">Review All Information:</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="company">
                                <h4>Company Details</h4>
                                <ul class="list-group mb-0">
                                    <li class="list-group-item"><b>Business Name : </b> {{$company->business_name}}</li>
                                    <li class="list-group-item"><b>Trading Name : </b> {{$company->trading_name}}</li>
                                    <li class="list-group-item"><b>ABN : </b> {{$company->abn}}</li>
                                    <li class="list-group-item"><b>Address : </b> {{$company->address}}</li>
                                    <li class="list-group-item"><b>Business Telephone : </b> {{$company->business_telephone_number}}</li>
                                    <li class="list-group-item"><b>Email Address : </b> {{$company->email_address}}</li>
                                    <li class="list-group-item"><b>Website : </b> {{$company->website}}</li>
                                </ul>
                            </div>
                            <div class="text-center mt-20">
                                <a class="btn btn-dark selected" href=" {{url('/supplierstep1')}}">EDIT</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="company">
                                <h4>User Profile</h4>
                                <table class="table display" id="customers">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($all_supplier_data as $key => $value) {

                                            echo "
                                            <tr>
                                            <td><p class='mt-5'>".$value->first_name." ".$value->last_name."</p></td>
                                            <td class='text-right'> <a href='".url('/supplierstep2').'/'.$value->id."' >
                                            <button type='button' class='btn btn-default'> Edit</button></a> 
                                            </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-20">
                                <!-- <button class="btn btn-dark selected"> EDIT</button> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="company">
                                <h4>Brand Details</h4>
                                <table class="table display" id="customers">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        foreach ($brands_list as $key => $value) {

                                            echo "
                                            <tr>
                                            <td><p class='mt-5'> ".$value->brand_name."</p></td>
                                            <td class='text-right'> <a href='".url('/supplierstep3').'/'.$value->id."' >
                                            <button type='button' class='btn btn-default'> Edit</button></a> 
                                            </td>
                                            </tr>";
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-20">
                                
                                <a class="btn btn-dark selected" href="<?php echo url('/supplierstep3/n'); ?>">ADD A BRAND (AUTO-ACTIVATE)</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10 text-center">
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15">
                            <a href="{{ route('supplierstep3') }}" class="prev" id="prevBtn"><i class="ti-arrow-left"></i> &nbsp;PREVIOUS</a>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <ul class="pagination pagination-split">
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0)">4</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-15 text-right">
                           <a href="{{ route('finishSupplier') }}" class="next" id="nextBtn">FINISH 
                            <!-- &nbsp;<i class="ti-arrow-right"></i> -->
                           </a>

                       </div>
                   </div>
                   <hr>
               </div>
               <div class="col-md-1">&nbsp;</div>
           </div>
          <!--  <div class="row">
               <div class="col-md-2">&nbsp;</div>
               <div class="col-md-8 text-center mt-30 mb-40">
                <button class="btn btn-dark selected"> ACTIVATE SUPPLIER PROFILE</button>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div> -->
    </div>
</div>

</form>
<div class="footer">
    <div class="conatiner text-center">
        <div class="row">
            <div class="col-md-1 col-sm-1">&nbsp;</div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                {{-- <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <button class="btn btn-default btn-block"> + ADD NEW SUPPLIER</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <button class="btn btn-default btn-block"> + ADD A NEW USER</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <button class="btn btn-default btn-block"> +ADD A NEW BRAND</button>
                    </div>
                </div> --}}
                <button class="btn btn-default spbtn"> + ADD NEW SUPPLIER</button>
                <button class="btn btn-default spbtn m-l-20"> + ADD A NEW USER</button>
                <a href="<?php echo url('/supplierstep3/n'); ?>"><button type="button" class="btn btn-default spbtn m-l-20"> +ADD A NEW BRAND</button></a>
            </div>
            <div class="col-md-1 col-sm-1">&nbsp;</div>
        </div>
    </div>
</div>
@endsection