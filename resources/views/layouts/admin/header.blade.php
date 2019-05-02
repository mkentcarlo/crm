<!-- Top Menu Items -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap" style="padding-top: 7px;">
                <a href="index.html">
                    <img style="vertical-align: middle" width="30" class="brand-img" src="https://www.luxemontre.sg/wp-content/uploads/2018/11/mobile-logo-e1544059816890.png" alt="brand"/>
                    <span style="vertical-align: middle; margin-top: 6px;" class="brand-text">Luxe CRM</span>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="{{ url('/users/profile/'. auth()->user()->id) }}"><i class="zmdi zmdi-account"></i><span>Edit Information</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/users/change-password/'. auth()->user()->id) }}"><i class="zmdi zmdi-lock"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>  
</nav>
<!-- /Top Menu Items -->