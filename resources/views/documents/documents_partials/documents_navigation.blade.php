<ul class="documents-inner-nav nav nav-tabs">
    <li role="presentation" class="{{ Request::is( 'reports') ? 'active' : '' }}"><a href="/reports">СВОДНЫЕ ДАННЫЕ ПО ОТЧЕТУ</a></li>
    <li role="presentation" class="{{ Request::is( 'report') ? 'active' : '' }}"><a href="/reports/purchase">ПРИОБРЕТЕНИЕ</a></li>
    <li role="presentation" class="{{ Request::is( 'reports/depreciation') ? 'active' : '' }}" ><a href="/reports/depreciation">НАЧИСЛЕНИЕ ИЗНОСА</a></li>
    <li role="presentation" class="{{ Request::is( 'reports/decommission') ? 'active' : '' }}"><a href="/reports/decommission">СПИСАНИЕ</a></li>
</ul>