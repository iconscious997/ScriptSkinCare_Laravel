@extends('layouts.master')

@section('content')
<div class="">
    <div class="dashboard">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg1 bdright">
            <div class="">
                <div>
                    <h4>Welcome {{ Auth::user()->name }}</h4>
                </div>
                <div class="items">
                    <h4 class="mb-30">Products that require approval</h4>
                    <div class="row mb-20">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                            <p>Product 1</p> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                            <button class="btn btn-default pull-right"> View </button>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                            <p>Product 2</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                            <button class="btn btn-default pull-right"> View </button>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                          <p>  Product 3</p>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                        <button class="btn btn-default pull-right"> View </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg1 bdright">
        <div class="">
            <div class="blank">
                <h4>&nbsp;</h4>
            </div>
            <div class="items">
                <h4>Products that are about to expire</h4>
                <div class="row mb-20">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                        <p>Product 1</p> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                        <button class="btn btn-default pull-right"> View </button>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                        <p>Product 2</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                        <button class="btn btn-default pull-right"> View </button>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                      <p>  Product 3</p>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                    <button class="btn btn-default pull-right"> View </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg1 bdright">
    <div class="">
        <div class="blank">
            <h4>&nbsp;</h4>
        </div>
        <div class="items">
            <h4>Products that have low inventory warning</h4>
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                    <p>Product 1</p> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                    <button class="btn btn-default pull-right"> View </button>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                    <p>Product 2</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                    <button class="btn btn-default pull-right"> View </button>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">
                  <p>  Product 3</p>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
                <button class="btn btn-default pull-right"> View </button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 dashblock bg2">
    <div class="">
        <div class="blank">
            <h4>&nbsp;</h4>
        </div>
        <div class="items">
            <h4>Sales Summary / Snapshot</h4>
            <p>Total Sales_</p>
            <p>Online Sales_</p>
            <p>Retail Sales_Overview_</p>
            <p>_Sales by Store 1_</p>
            <p>_Sales by Store 2_</p>
            <p>_Sales by Store 3_</p>
            <p>_Sales by Store 4_</p>
            <p>Average Spend_</p>
        </div>
    </div>
</div>
</div>
</div>
@endsection
