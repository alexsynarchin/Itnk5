<ul class="report-inner-nav nav nav-tabs">
    <li role="presentation" class="{{ Request::is( 'inspector/'.$report->id.'') ? 'active' : '' }}"><a href="{{route('report.show', [$report->id])}}">СВОДНЫЕ ДАННЫЕ ПО ОТЧЕТУ</a></li>
    <li role="presentation" class="{{ Request::is( 'report/'.$report->id.'/purchase') ? 'active' : '' }}"><a href="{{route('report.purchase',[$report->id])}}">ПРИОБРЕТЕНИЕ</a></li>
</ul>