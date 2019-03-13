<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main Navigation</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="dashboard.php" class=""><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="icon-user mr-20"></i><span class="right-nav-text">Users</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ecom_dr" class="collapse collapse-level-1">
                <li>
                    <a href="{{ route('view.user') }}" class="">List</a>
                </li>
                <li>
                    <a href="{{ route('view.role') }}" class="">Roles</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#cust_dr"  class=""><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Customers</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="cust_dr" class="collapse collapse-level-1">
                <li>
                    <a href="{{ route('view.customer') }}" class="">List</a>
                </li>
                <li>
                    <a href="{{ route('view.group') }}">Groups</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="queries.php" class=""><div class="pull-left"><i class="fa fa-envelope-square mr-20" aria-hidden="true"></i><span class="right-nav-text">Enquiries </span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="zmdi zmdi-time mr-20"></i><span class="right-nav-text">Watches </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="app_dr" class="collapse collapse-level-1">
                <li>
                    <a href="{{ route('view.product') }}" class="">List</a>
                </li>
                <li>
                    <a href="{{ route('create.product') }}">Add Watch</a>
                </li>
                <li>
                    <a href="{{ route('view.brand') }}" class="">brands</a>
                </li>
                <li>
                    <a href="{{ route('view.category') }}" class="">categories</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#invoicemgt" class=""><div class="pull-left"><i class="fa fa-file-text-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Invoice Management </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="invoicemgt" class="collapse collapse-level-1">
                <li>
                    <a href="invoice-management.php">List</a>
                </li>
                <li>
                    <a href="add-invoice.php">Add Invoice</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="reports.php" class=""><div class="pull-left"><i class="fa fa-bar-chart-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Reports </span></div><div class="clearfix"></div></a>
        </li>
    </ul>
</div>