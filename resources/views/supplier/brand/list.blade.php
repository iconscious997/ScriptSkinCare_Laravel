@extends('supplier.suppliermaster')
@section('content')

<div class="wizard bg3">
    <div class="col-md-12">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left mt-10">
            <h3 class="text-left">Full Brand List for [Supplier Name]</h3>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
                    <button class="btn btn-default m-l-5 btn-block" onclick="location.href='{{ route('supplierproductstep1') }}';"> + ADD NEW PRODUCT LINE</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-right">
                    <button class="btn btn-default m-l-5 btn-block" onclick="location.href='{{ route('supplierproductstep1') }}';"> + ADD NEW BRAND</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right">
                    <div class="dropdown export">
                        <button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu"  id="buttons">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-fix ">
        <div class="table-responsive mb-30">
            <table class="table display" id="customers">
                <thead class="thead-dark">
                    <tr>
                        <th>Brand Name</th>
                        <th>Registered Business Name</th>
                        <th>Brand Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->brand_name }}</td>
                        <td>{{ $item->business_name }}</td>
                        <td>
                            <img class="img-responsive" style="width:50px; " src="{{ asset('public/images/brand').'/'.$item->brand_logo }}">
                        </td>
                        <td>
                            <a href="{{ route('supplierbrandedit',$item->id) }}" data-id="{{$item->id}}">
                                <button type="button" class="btn btn-default"> EDIT</button>
                            </a> 
                        </td>
                    </tr>                                
                    @endforeach                             
                </tbody>
            </table>
        </div>
    </div>
    <div id="footer" class="width50">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Search Brands
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="clearfix">&nbsp;</div>
                                <div class="accordionblock">
                                    <div class="row">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="Brand Name:" value="">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="Supplier: [Default By Log-In]" value="">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="Status:" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="advsearch">Advanced Search</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <input type="hidden" name="search" value="Users">
                                                    <button class="btn btn-default pull-right" type="submit">VIEW RESULTS</button>
                                                </p>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Search Users
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="clearfix">&nbsp;</div>
                                <div class="accordionblock">
                                    <div class="row">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="Last Name:" value="">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="Email:" value="">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="" placeholder="User Role:" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="advsearch">Advanced Search</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <input type="hidden" name="search" value="Users">
                                                    <button class="btn btn-default pull-right" type="submit">VIEW RESULTS</button>
                                                </p>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#customers').DataTable();
        } );

        $(document).on("click", ".deactivaterow", function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var msg = $(this).attr('msg');
            var status = 0;
            if(msg == 'Deactivate') {
                status = 1;
            }
            swal({
                title: 'Are you sure?',
                text: "You want to "+msg+"!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, '+msg+'',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
        // call ajax function to delete it
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_mytoken"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "<?php echo url('/customeractivedeactive')?>/"+id+"/"+status,
            success: function(data) {
                swal({
                    title: msg+'!',
                    text: 'Brand has been '+msg+'d.',
                    type: 'success'
                }).then(function() {
                    location.reload();
                });
            },
            error: function() {
                alert('error');
            }
        })
    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
    })

        })
    </script>
    @endsection
    @section('scripts')
    @include('layouts.datatablejs')
    @endsection