<ul class="report-inner-nav nav nav-tabs">
    <li role="presentation" class="{{ Request::is( 'inspector') ? 'active' : '' }}"><a href="{{route('inspector.index')}}">СПИСОК ОРГАНИЗАЦИЙ</a></li>
    <li role="presentation" class="{{ Request::is( 'inspector/reports') ? 'active' : '' }}"><a href="{{route('inspector.reports')}}">ОТЧЕТЫ</a></li>
</ul>