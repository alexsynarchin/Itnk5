<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials_dashboard.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        @include('layouts.partials_dashboard.header')
    </header>
    @include('layouts.partials_dashboard.aside')
            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div><!-- /.content-wrapper -->
    @include('layouts.partials_dashboard.footer')
</div>
@include('layouts.partials_dashboard.scripts')
@yield('user-scripts')
</body>
</html>