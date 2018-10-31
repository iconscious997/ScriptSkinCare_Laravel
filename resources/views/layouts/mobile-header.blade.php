<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_mytoken" content="{{csrf_token()}}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/icon" sizes="16x16" href="{{ ('public/assets/images/favicon.ico') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Custom CSS -->
    <!-- Sweet Alert -->
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @yield('styles')
</head>

<body>
    <header>
        <div class="container">
            <div class="row Headermobile">
                <div class="col-xs-1">
                    <a id="menu-toggle" type="" class="toogle">
                        <i class="ti-align-left"></i>
                    </a>
                </div>
                <div class="name col-xs-7">
                    <h4><a href="{{ route('home') }}">Script Skincare </a></h4>
                </div>
                <div class="col-xs-4 icons">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i> 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>


    </header>

    <div id="sidebar-wrapper">

        <ul class="sidebar-nav">
            <div class="canvi-user-info">
                <a href="" class="canvi-user-info__meta" data-toggle="modal" data-target=".loginModal">
                    <div class="canvi-user-info__image">
                        <i class="ti-user"></i>
                    </div>
                    <div class="canvi-user-info__data">
                        <span class="canvi-user-info__title">Welcome </span>
                        <a href="#" class="canvi-user-info__meta">{{ Auth::user()->name }}</a>
                        <div class="canvi-user-info__close" id="menu-close"></div>
                    </div>
                </a>
            </div>
        </ul>
        <ul class="nav navmenu-nav navmenu-nav-new canvi-navigation"">
            <li>
                <a href="{{ route('home') }}"  >
                    <div class="col-xs-12">
                        Home
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id="btn-0" data-toggle="collapse" data-target="#submenu_0" aria-expanded="false" class="" >
                    <div class="col-xs-12">
                        Suppliers
                    </div>
                </a>
                <ul class="nav collapse" id="submenu_0" role="menu" aria-labelledby="btn-0">
                    @can('supplier_list')
                    <li><a href="{{ route('supplier') }}" class="">Supplier List</a></li>
                    @endcan
                    @can('setup_new_supplier')
                    <li><a href="{{ route('supplierstep1') }}" class="">Set-Up New Supplier</a></li>
                    @endcan
                    @can('manage_edit_supplier')
                    <li><a href="{{ route('company-list')}}">Manage / Edit A Supplier</a></li>
                    @endcan
                    @can('manage_user_permission')
                    <li><a href="{{ route('supplier-data-list') }}">Manage User Permissions</a></li>
                    @endcan
                    @can('manage_brand')
                    <li><a href="{{ route('brand-list')}}">Manage Brands</a></li>
                    @endcan
                    @can('manage_role_permission')
                    <li><a href="{{ route('supplierpermission') }}">Manage Role Permissions</a></li>
                    @endcan
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" id="btn-1" data-toggle="collapse" data-target="#submenu_1" aria-expanded="false" class="" >
                    <div class="col-xs-12">
                        Retail
                    </div>
                </a>
                <ul class="nav collapse" id="submenu_1" role="menu" aria-labelledby="btn-1">
                    <li><a href="{{ route('retail') }}" class="">Retailer List</a></li>
                    <li><a href="{{ route('retailadd') }}" class="">Set-Up New Retail</a></li>
                    <li><a href="{{ route('retail-site-list') }}" class="">Manage / Edit Retail</a></li>
                    <li><a href="{{ route('retail-user-list') }}" class="">Manage Retail User Permission</a></li>
                </ul>
            </li>
            <li>
                <a href="#" id="btn-2" data-toggle="collapse" data-target="#submenu_2" aria-expanded="false" class="" >
                    <div class="col-xs-12">
                        Online
                    </div>
                </a>
                <ul class="nav collapse" id="submenu_2" role="menu" aria-labelledby="btn-2">
                 <li><a href="{{ route('orders') }}">Orders</a> </li>
                 <li><a href="{{ route('customer') }}">Customers</a> </li>
                 <li><a href="{{ route('coupons') }}" >Coupons</a> </li>
                 <li><a href="{{ route('reports') }}">Reports</a> </li>
             </ul>
         </li>
         <li>
            <a href="javascript:void(0)" id="btn-3" data-toggle="collapse" data-target="#submenu_3" aria-expanded="false" class="" >
                <div class="col-xs-12">
                    Customers
                </div>
            </a>
            <ul class="nav collapse" id="submenu_3" role="menu" aria-labelledby="btn-3">
                <li><a href="{{ route('customers') }}" class="">Search & View</a></li>
                <li><a href="{{ route('customeradd') }}" class="">Create New Customer Profile</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('sales') }}" >
                <div class="col-xs-12">
                    Sales
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)"  >
                <div class="col-xs-12">
                    Admin
                </div>
            </a>
        </li>
    </ul>

</div>
