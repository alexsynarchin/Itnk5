<ul class="documents-inner-nav nav nav-tabs">
    <li role="presentation" class="{{ Request::is( 'documents') ? 'active' : '' }}"><a href="/documents">СВОДНЫЕ ДАННЫЕ ПО ОТЧЕТУ</a></li>
    <li role="presentation" class="{{ Request::is( 'documents/purchase') ? 'active' : '' }}"><a href="/documents/purchase">ПРИОБРЕТЕНИЕ</a></li>
    <li role="presentation" class="{{ Request::is( 'documents/depreciation') ? 'active' : '' }}" ><a href="/documents/depreciation">НАЧИСЛЕНИЕ ИЗНОСА</a></li>
    <li role="presentation" class="{{ Request::is( 'documents/decommission') ? 'active' : '' }}"><a href="/documents/decommission">СПИСАНИЕ</a></li>
</ul>