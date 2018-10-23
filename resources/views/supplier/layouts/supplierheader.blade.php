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
                        <h3 class="text-center l-1"><a href="{{ route('supplierhome') }}">Script Skincare</a></h3>
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
                        <a href="{{ route('supplierhome') }}" class="{{ request()->is('supplier/home') ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('supplier/pro*') ? 'active' : '' }}">Products</a>
                        <ul class="sub-menu {{ request()->is('supplier/pro*') ? 'open' : '' }}">
                           
                            @can('product_list')
                            <li><a href="{{ route('supplierproduct') }}" class="{{ request()->is('supplier/product') ? 'active' : '' }}">Product List</a></li>
                            @endcan
                            @can('new_product')
                            <li><a href="{{ route('supplierproductadd') }}" class="{{ request()->is('supplier/productadd') ? 'active' : '' }}">Add New Product</a></li>
                            @endcan
                            @can('manage_role_permission')
                            <li><a href="{{ route('supplierpermission') }}" class="{{ request()->is('supplierpermission') ? 'active' : '' }}">Manage Role Permissions</a></li>
                            @endcan
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('supplier/com*') ? 'active' : '' }}">Companys</a>
                        <ul class="sub-menu {{ request()->is('supplier/com*') ? 'open' : '' }}">
                            <li><a href="{{ route('suppliercompany') }}" class="{{ request()->is('supplier/company') ? 'active' : '' }}">Company List</a></li>
                            <li><a href="{{ route('suppliercompanyadd') }}" class="{{ request()->is('supplier/companyadd') ? 'active' : '' }}">Create New Company</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('supplier/brand*') ? 'active' : '' }}">Brands</a>
                        <ul class="sub-menu {{ request()->is('supplier/brand*') ? 'open' : '' }}">
                            <li><a href="{{ route('supplierbrand') }}" class="{{ request()->is('supplier/brand') ? 'active' : '' }}">Brand List</a></li>
                            <li><a href="{{ route('supplierbrandadd') }}" class="{{ request()->is('supplier/brandadd') ? 'active' : '' }}">Create New Brand</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="{{ request()->is('supplier/line*') ? 'active' : '' }}">Products line</a>
                        <ul class="sub-menu {{ request()->is('supplier/line*') ? 'open' : '' }}">
                            <li><a href="{{ route('supplierproductline') }}" class="{{ request()->is('supplier/line') ? 'active' : '' }}">Product line List</a></li>
                            <li><a href="{{ route('supplierproductlineadd') }}" class="{{ request()->is('supplier/lineadd') ? 'active' : '' }}">Create New Product line</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>