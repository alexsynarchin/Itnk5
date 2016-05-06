<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Навигация</li>
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::user() -> username != '1-0275071849')
            <li class="{{ Request::is( 'home') ? 'active' : '' }}"><a href="/home"><i class="fa fa-dashboard"></i> <span>Главная</span></a></li>
            <li class="{{ Request::is( 'residues_entering') ? 'active' : '' }}"><a href="/residues_entering"><i class="fa fa-folder-open-o"></i> <span>Ввод остатков</span></a></li>
            <li class="{{ Request::is( 'report') ? 'active' : '' }}"><a href="/reports"><i class="fa fa-file-text-o"></i> <span>Отчеты</span></a></li>
            <li class="{{ Request::is( 'items') ? 'active' : '' }}"><a href="/items"><i class="fa fa-database"></i> <span>Основные средства</span></a></li>
            <li class="{{ Request::is( 'help') ? 'active' : '' }}"><a href="/help"><i class="fa fa-user"></i> <span>Помощь</span></a></li>
            @endif
            @if(Auth::user() -> username == 'admin')
                <li class="{{ Request::is( 'admin') ? 'active' : '' }}"><a href="/admin"><i class="fa fa-pencil-square-o"></i></i> <span>Администрирование</span></a></li>
            @endif
            @if(Auth::user() -> username == '1-0275071849')
                <li class="{{Request::is('inspector') ? 'active' : ''}}"><a href="/inspector"><i class="fa fa-eye"></i> <span>Инспектор</span></a></li>
            @endif
            <li class="{{ Request::is( 'organization') ? 'active' : '' }}"><a href="/organization"><i class="fa fa-building"></i> <span>Организация</span></a></li>
            <li class="{{ Request::is( 'profile') ? 'active' : '' }}"><a href="/profile"><i class="fa fa-user"></i> <span>Профиль</span></a></li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> <span>Выход</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>