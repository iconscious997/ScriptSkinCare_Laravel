@extends('supplier.suppliermaster')
@section('content')


<div class="">
    <div class="dashboard">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashblock2 bg3 bdright">
            <div class="text-center mt-40">

                <h4>{{Session::get('company_name')}}</h4>

                <p>
                    <a href="company"><button class="btn btn-default btn-block" type="button"> 
                        VIEW FULL DETAILS
                    </button></a>
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashblock2 bg3 bdright">
            <div class="text-center mt-40">
                <h4>[Brands & Product Lines]</h4>
                <p>
                    <a href="{{ route('supplierbrandadd') }}"><button class="btn btn-default btn-block" type="button"> 
                        VIEW FULL DETAILS
                    </button></a>
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dashblock2 bg3 bdright">
            <div class="text-center mt-40">
                <h4>[Users]</h4>
                <p>
                    <button class="btn btn-default btn-block" onclick="location.href='{{ route('supplieruseradd') }}';"> 
                        VIEW FULL DETAILS
                    </button>
                </p>
            </div>
        </div>
    </div>
</div>


@endsection