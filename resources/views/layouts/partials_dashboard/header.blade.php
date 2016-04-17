<figure class="logo">
    <img src="/assets/images/logo-dashboard.png">
</figure>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <h5 class="organization-name">{{Auth::user() -> organization -> short_name}}</h5>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="/profile" class="btn btn-default btn-flat">Профиль</a>
                        </div>
                        <div class="pull-right">
                            <a href="/auth/logout" class="btn btn-default btn-flat">Выйти из системы</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
