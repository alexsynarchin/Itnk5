<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Навигация</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is( 'home') ? 'active' : '' }}"><a href="/home"><i class="fa fa-dashboard"></i> <span>Главная</span></a></li>
            <li class="{{ Request::is( 'documents') ? 'active' : '' }}"><a href="/documents"><i class="fa fa-file-text-o"></i> <span>Документы</span></a></li>
            <li class="{{ Request::is( 'items') ? 'active' : '' }}"><a href="items"><i class="fa fa-database"></i> <span>Основные средства</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>