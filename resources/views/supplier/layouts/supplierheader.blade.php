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
            <ul class="menu menu2">
                <li>
                    <a href="{{ route('supplierhome') }}" class="{{ request()->is('supplier/home') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="{{ request()->is('supplier/pro*') ? 'active' : '' }}">Products Database</a>
                    <ul class="sub-menu {{ request()->is('supplier/pro*') ? 'open' : '' }}">

                        @can('product_list')
                        <li><a href="{{ route('supplierproduct') }}" class="{{ request()->is('supplier/product') ? 'active' : '' }}">Product List</a></li>
                        @endcan
                        @can('new_product')
                        <li><a href="{{ route('supplierproductstep1') }}" class="{{ request()->is('supplier/productstep*') ? 'active' : '' }}">Add New Product</a></li>
                        @endcan
                        <li><a href="javascript:void(0)" class="">Manage A Products</a></li>
                        @can('manage_role_permission')
                        <li><a href="{{ route('supplierpermission') }}" class="{{ request()->is('supplierpermission') ? 'active' : '' }}">Manage Role Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                <li>
                    <a href="{{ route('suppliercompanydashborad') }}" class="{{ request()->is('supplier/com*') ? 'active' : '' }} {{ request()->is('supplier/brand*') ? 'active' : '' }} {{ request()->is('supplier/user*') ? 'active' : '' }} ">Company Details,Brands & Users</a>
                    <ul class="sub-menu {{ request()->is('supplier/com*') ? 'open' : '' }} {{ request()->is('supplier/brand*') ? 'open' : '' }} {{ request()->is('supplier/user*') ? 'open' : '' }}">

                       <li><a href="{{ route('suppliercompany') }}" class="{{ request()->is('supplier/company*') ? 'active' : '' }}">Company Details</a></li>

                       <li><a href="{{ route('supplierbrand') }}" class="{{ request()->is('supplier/brand*') ? 'active' : '' }}">Brands</a></li>

                       <li><a href="{{ route('supplieruser') }}" class="{{ request()->is('supplier/user*') ? 'active' : '' }}">Users</a></li>
                    </ul>
                </li>               
            </ul>
        </div>
    </nav>
</header>