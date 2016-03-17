<ul class="report-inner-nav nav nav-tabs">
    <li role="presentation" class="{{ Request::is( 'report/'.$report->id.'') ? 'active' : '' }}"><a href="{{route('report.show', [$report->id])}}">СВОДНЫЕ ДАННЫЕ ПО ОТЧЕТУ</a></li>
    <li role="presentation" class="{{ Request::is( 'report/'.$report->id.'/purchase') ? 'active' : '' }}"><a href="{{route('report.purchase',[$report->id])}}">ПРИОБРЕТЕНИЕ</a></li>
    <li role="presentation" class="{{ Request::is( 'report/'.$report->id.'/depreciation') ? 'active' : '' }}" ><a href="{{route('report.depreciation',[$report->id])}}">НАЧИСЛЕНИЕ ИЗНОСА</a></li>
    <li role="presentation" class="{{ Request::is( 'report/'.$report->id.'/decommission') ? 'active' : '' }}"><a href="{{route('report.decommission',[$report->id])}}">СПИСАНИЕ</a></li>
</ul>