<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_mytoken" content="{{csrf_token()}}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ ('public/assets/images/favicon.ico') }}">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
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
    <script type="text/javascript" src="{{ asset('assets/plugins/charts/modernizr.min.js') }}"></script>

    @yield('styles')
</head>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="logo">
                        <h3 class="text-center l-1"><a href="{{ route('home') }}">Script Skincare</a></h3>
                    </div>
                    <div class="header-top-right hidden-xs">
                        <ul>
                            <li>
                                <div class="header-top-contact">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="font10">LOGOUT</a> 
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <nav class="menu_section">
            <div class="container">
                <ul class="menu">
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('supplier*') ? 'active' : '' }}">Suppliers</a>
                        <ul class="sub-menu {{ request()->is('supplier*') ? 'open' : '' }}">
                           
                            @can('supplier_list')
                            <li><a href="{{ route('supplier') }}" class="{{ request()->is('supplier') ? 'active' : '' }}">Supplier List</a></li>
                            @endcan
                            @can('setup_new_supplier')
                            <li><a href="{{ route('supplierstep1') }}" class="{{ request()->is('supplierstep*') ? 'active' : '' }}">Set-Up New Supplier</a></li>
                            @endcan
                            @can('manage_edit_supplier')
                            <li><a href="{{ route('company-list')}}" class="{{request()->is('supplier-company*') ?'active':'' }}" >Manage / Edit A Supplier</a></li>
                            @endcan
                            @can('manage_user_permission')
                            <li><a href="{{ route('supplier-data-list') }}" class="{{ request()->is('supplieruser*') ? 'active' : '' }}">Manage User Permissions</a></li>   
                            @endcan
                            @can('manage_brand')
                            <li><a href="{{ route('brand-list')}}" class="{{ request()->is('supplier-brand*') ? 'active' : '' }}">Manage Brands</a></li>
                            @endcan
                            @can('manage_role_permission')
                            <li><a href="{{ route('supplierpermission') }}" class="{{ request()->is('supplierpermission') ? 'active' : '' }}">Manage Role Permissions</a></li>
                            @endcan
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('retail*') ? 'active' : '' }}">Retail</a>
                        <ul class="sub-menu {{ request()->is('retail*') ? 'open' : '' }}" >
                            <li><a href="{{ route('retail') }}" class="{{ request()->is('retail') ? 'active' : '' }}">Retail List</a></li>                        
                            <li><a href="{{ route('retailadd') }}" class="{{ request()->is('retailadd') ? 'active' : '' }}">Set-Up New Retail</a></li>

                                <li><a href="{{ route('retail-site-list') }}" class="{{ request()->is('retail-site-list') ? 'active' : '' }}">Manage / Edit Retail</a></li>                        
                                <li><a href="{{ route('retail-user-list') }}" class="{{ request()->is('retail-user-list') ? 'active' : '' }}">Manage Retail User Permission</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Online</a>
                        <ul class="sub-menu">

                            <li><a href="{{ route('orders') }}" class="{{ request()->is('orders') ? 'active' : '' }}">Orders</a> </li>
                            <li><a href="{{ route('customer') }}" class="{{ request()->is('customers') ? 'active' : '' }}">Customers</a> </li>
                            <li><a href="{{ route('coupons') }}" class="{{ request()->is('coupons') ? 'active' : '' }}">Coupons</a> </li>
                            <li><a href="{{ route('reports') }}" class="{{ request()->is('reports') ? 'active' : '' }}">Reports</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('customer*') ? 'active' : '' }}">Customers</a>
                        <ul class="sub-menu {{ request()->is('customer*') ? 'open' : '' }}">
                            <li><a href="{{ route('customers') }}" class="{{ request()->is('customers') ? 'active' : '' }}">Search & View</a></li>
                            <li><a href="{{ route('customeradd') }}" class="{{ request()->is('customeradd') ? 'active' : '' }}">Create New Customer Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('sales') }}">Sales</a>
                    </li>
                    <li>
                        <a href="#">Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>