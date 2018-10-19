@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/plugins/dateranger/daterangepicker.css') }}" >
<link rel="stylesheet" href="{{ asset('assets/plugins/charts/c3.min.css') }}" >

<script type="text/javascript" src="{{ asset('assets/plugins/dateranger/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/dateranger/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/charts/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/charts/c3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/charts/jquery.c3-chart.init.js') }}"></script>
<form action="" method="" id="first">

    <div class="wizard spcust">
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-left">
            <h3 class="text-left mt-20">Reports</h3>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 mt-15">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 pull-right">
                <div class="dropdown export">
                    <button class="btn btn-default m-l-5 btn-block dropdown-toggle" type="button" data-toggle="dropdown">EXPORT DATA OPTIONS
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#">Export PDF</a></li>-->
                        <li><a href="javascript:void(0)"  onClick ="$('#customers').tableExport({type:'excel',escape:'false',tableName:'yourTableName'});">Export Excel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content-fix ">
        <div class="filter-section">
            <div class="">
                <div class="col-md-3 col-xs-12">
                    <ul>
                        <li ><a href="#home" >Year</a></li>
                        <li><a href="#news">Last Month </a></li>
                        <li><a href="#contact" >This Month</a></li>
                        <li><a  href="#about" class="active">Last 7 Days</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="input-group" style="display: flex;">
                        <input class="form-control date-range" type="text" name="daterange" placeholder="Custom: yyyy-mm-dd - yyyy-mm-dd" value="" readonly="">                
                        <button class="btn btn-green gobtn" >GO</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="graph-section mt-30 mb-30">

            <div class="col-md-2 text-left">
                <ul class="list-group mb-20 graphbd">
                    <li class="list-group-item a"><b>$2,281.40 </b><span> Gross sales in this period</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Average gross daily sales</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Net sales in this period</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Average net daily sales</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Orders placed</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Items purchased</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Refunded 0 orders (0 items)</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Charged for shipping</span></li>
                    <li class="list-group-item"><b>$2,281.40 </b><span> Worth of coupons used</span></li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="graphBorder">
                    <div id="combine-chart"></div>
                </div>
            </div>

        </div>
    </div>

</form>
<script type="text/javascript">

    !function($) {
        "use strict";

        var ChartC3 = function() {};

        ChartC3.prototype.init = function () {


        //combined chart
        c3.generate({
            bindto: '#combine-chart',
            data: {
                columns: [
                ['data1', 30, 20, 50, 40, 60, 50],
                ['data2', 200, 130, 90, 240, 130, 220],
                ['data3', 300, 200, 160, 400, 250, 250],
                ['data4', 200, 130, 90, 240, 130, 220],
                ],
                types: {
                    data1: 'bar',
                    data2: 'bar',
                    data3: 'spline',
                    data4: 'line',
                },
                colors: {
                    data1: '#D0DEE1',
                    data2: '#F0E4D9',
                    data3: '#36404a',
                    data4: '#fb6d9d',
                },
                groups: [
                ['data1','data2']
                ]
            },
            axis: {
                x: {
                    type: 'categorized'
                }
            }
        });
        

        //Donut Chart
        c3.generate({
         bindto: '#donut-chart',
         data: {
            columns: [
            ['Customer Sales', 50],
            ['Guest Sales', 50],
            ],
            type : 'donut'
        },
        donut: {
            title: "",
            width: 15,
            label: { 
                show:false
            }
        },
        color: {
            pattern: ["#D0DEE1", "#F0E4D9"]
        }
    });


    },
    $.ChartC3 = new ChartC3, $.ChartC3.Constructor = ChartC3

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.ChartC3.init()
}(window.jQuery);

</script>

@endsection