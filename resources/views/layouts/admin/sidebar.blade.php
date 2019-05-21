<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main Navigation</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{ route('home') }}" class="{{Route::current()->getName() == 'home' ? 'active' : ''}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
        </li>
        @can('view.user')
        <li>
            <a class="{{in_array(Route::current()->getName(), array('view.user', 'view.role')) ? 'active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="icon-user mr-20"></i><span class="right-nav-text">Users</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ecom_dr" class="collapse collapse-level-1 {{in_array(Route::current()->getName(), array('view.user', 'view.role')) ? 'in' : ''}}">
                <li>
                    <a class="{{Route::current()->getName() == 'view.user' ? 'active-page' : ''}}" href="{{ route('view.user') }}" class="">List</a>
                </li>
                @role('super admin')
                <li>
                    <a class="{{Route::current()->getName() == 'view.role' ? 'active-page' : ''}}" href="{{ route('view.role') }}" class="">Roles</a>
                </li>
                @endrole
            </ul>
        </li>
        @endcan
        @can('view.customer')
        <li>
            <a class="{{in_array(Route::current()->getName(), array('view.customer', 'view.group')) ? 'active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#cust_dr"  class=""><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Customers</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="cust_dr" class="collapse collapse-level-1 {{in_array(Route::current()->getName(), array('view.customer', 'view.group')) ? 'in' : ''}}">
                <li>
                    <a class="{{Route::current()->getName() == 'view.customer' ? 'active-page' : ''}}" href="{{ route('view.customer') }}" class="">List</a>
                </li>
                <li>
                    <a class="{{Route::current()->getName() == 'view.group' ? 'active-page' : ''}}" href="{{ route('view.group') }}">Groups</a>
                </li>
            </ul>
        </li>
        @endcan
        <li>
            <a href="{{ route('view.inquiries') }}" class="{{Route::current()->getName() == 'view.inquiries' ? 'active' : ''}}"><div class="pull-left"><i class="fa fa-envelope-square mr-20" aria-hidden="true"></i><span class="right-nav-text">Enquiries </span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="{{in_array(Route::current()->getName(), array('view.product','create.product','view.brand', 'view.category')) ? 'active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="zmdi zmdi-time mr-20"></i><span class="right-nav-text">Watches </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="app_dr" class="collapse collapse-level-1 {{in_array(Route::current()->getName(), array('view.product','create.product','view.brand', 'view.category')) ? 'in' : ''}}">
                @can('view.product')
                <li>
                    <a class="{{Route::current()->getName() == 'view.product' ? 'active-page' : ''}}" href="{{ route('view.product') }}" class="">List</a>
                </li>
                <li>
                    <a class="{{Route::current()->getName() == 'create.product' ? 'active-page' : ''}}" href="{{ route('create.product') }}">Add Watch</a>
                </li>
                @endcan
                @can('view.brand')
                <li>
                    <a class="{{Route::current()->getName() == 'view.brand' ? 'active-page' : ''}}" href="{{ route('view.brand') }}" class="">brands</a>
                </li>
                @endcan
                @can('view.category')
                <li>
                    <a class="{{Route::current()->getName() == 'view.category' ? 'active-page' : ''}}" href="{{ route('view.category') }}" class="">categories</a>
                </li>
                @endcan
            </ul>
        </li>
        @can('view.invoice')
        <li>
            <a class="{{Route::current()->getName() == 'view.invoice' ? 'active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#invoicemgt" class=""><div class="pull-left"><i class="fa fa-file-text-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Invoice Management </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="invoicemgt" class="collapse collapse-level-1 {{Route::current()->getName() == 'view.invoice' ? 'in' : ''}}">
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'sales' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=sales') }}">Sales</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'consign_in' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=consign_in') }}">Consign In</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'consign_out' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=consign_out') }}">Consign Out</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'purchase' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=purchase') }}">Purchase</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'repair' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=repair') }}">Repair</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'others' && Route::current()->getName() == 'view.invoice' ? 'active-page' : ''}}" href="{{ url('/invoice?invoice_type=others') }}">Others</a>
                </li>
            </ul>
        </li>
        @endcan
        <li>
            <!-- <a href="{{ route('view.report') }}" class=""><div class="pull-left"><i class="fa fa-bar-chart-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Reports </span></div><div class="clearfix"></div></a> -->
             <a href="javascript:void(0);" data-toggle="collapse" data-target="#reportmgt" class="{{Route::current()->getName() == 'view.report' ? 'active' : ''}}"><div class="pull-left"><i class="fa fa-bar-chart-o mr-20" aria-hidden="true"></i><span class="right-nav-text">Report Management </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="reportmgt" class="collapse collapse-level-1 {{Route::current()->getName() == 'view.report' ? 'in' : ''}}">
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'sales' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}" href="{{ url('/reports?invoice_type=sales') }}">Sales</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'consign_in' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}" href="{{ url('/reports?invoice_type=consign_in') }}">Consign In</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'consign_out' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}" href="{{ url('/reports?invoice_type=consign_out') }}">Consign Out</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'purchase' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}" href="{{ url('/reports?invoice_type=purchase') }}">Purchase</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'repair' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}" href="{{ url('/reports?invoice_type=repair') }}">Repair</a>
                </li>
                <li>
                    <a class="{{app('request')->input('invoice_type') == 'others' && Route::current()->getName() == 'view.report' ? 'active-page' : ''}}"  href="{{ url('/reports?invoice_type=others') }}">In vs Out</a>
                </li>
            </ul>
        </li>
    </ul>
</div>