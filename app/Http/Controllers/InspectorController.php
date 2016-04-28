<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Excel;
use Response;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;

class InspectorController extends Controller
{
    public function index()
    {
        return View::make('inspector.index');
    }
    public function getOrganizations()
    {
        $organizations= \App\Models\Organization::where('type','client');
        $datatables = Datatables::of($organizations)
            ->addColumn('action',function($organization){
                return '<a href="inspector/organization/'.$organization->id.'" class="actions icons"><i class="fa fa-eye"></i></a>';
            });
        return $datatables->make(true);
    }
    public function showOrganization($id){
        $organization=\App\Models\Organization::find($id);
        $user =  \App\Models\Organization::find($id)-> user();
        $documents =  \App\Models\User::find($organization->user->id)->documents;
        return View::make('inspector.showOrganization', compact('organization','documents','user'));
    }
    public function reports()
    {
        $reports=\App\Models\Report::where('state','inspection')->get();
        return View::make('inspector.reports',compact('reports'));
    }
    public function acceptedReports()
    {
        $reports=\App\Models\Report::where('state','accepted')->get();
        return View::make('inspector.reports',compact('reports'));
    }
    public  function postReportExcel($id)
    {
        $report=\App\Models\Report::find($id);
        $organization = $report -> organization;
        $filename =$organization->short_name .'_' . $organization -> inn .'_' . $report -> quarter . "_квартал_" . $report -> year . "_года";
        $file = Excel::create($filename, function($excel)use($report) {
            $excel->sheet(' Сводные данные по отчету', function($sheet)use($report) {
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('A5:E5');
                $sheet->mergeCells('A10:E10');
                $sheet->mergeCells('A14:E14');
                $sheet->fromArray(array(
                    array('Итоговые суммы по отчету'),
                    array('Балансовая стоимость', 'Начисленный износ', 'Сумма списания', 'Остаточная стоимость'),
                    array($report->report_total_carrying_amount, $report->report_wearout_value, $report->decommission_carrying_amount, $report->report_total_residual_value),
                    array(''),
                    array('Сводные данные по приобретению'),
                    array('','Итого','	Движимое имущество','Особо ценное движимое имущество','	Здания и сооружения','Земельные участки','Автомобили'),
                    array('Балансовая стоимость',$report->report_carrying_amount,$report->report_movables_carrying_amount,$report->report_value_movables_carrying_amount,$report->report_buildings_carrying_amount,$report->report_parcels_carrying_amount,$report->report_cars_carrying_amount),
                    array('Остаточная стоимость',$report->report_residual_value,$report->report_movables_residual_value,$report->report_value_movables_residual_value,$report->report_buildings_residual_value,$report->report_parcels_residual_value,$report->report_cars_residual_value),
                    array(''),
                    array('Сводные данные по начислению износа'),
                    array('Балансовая стоимость','Начисление износа','Остаточная стоимость'),
                    array($report->report_wearout_carrying_amount,$report->report_wearout_value,$report->report_wearout_residual_value),
                    array(''),
                    array('Сводные данные по списанию основных средств'),
                    array('Балансовая стоимость','Сумма списания'),
                    array($report->decommission_carrying_amount,$report->decommission_sum)
                ), null, 'A1', false, false);
            });
           $excel->sheet('Приобретение', function($sheet)use($report) {
                $items = $report ->items;
                foreach($items as $item) {
                    $data[] = array($item->number, $item->name, $item->carrying_amount, $item->okof != 0 ? $item->okof: 'Земельный участок',isset($item->variable->residual_value) ? $item->variable->residual_value: 0);
                }
                $sheet->fromArray(array(
                    array('Инвертарный номер','Наименование','Балансовая стоимость', 'Код ОКОФ', 'Остаточная стоимость'),
                ), null, 'A1', false, false);
                $sheet->fromModel($data,null,'A1', false, false);
            });

            $excel->sheet('Начисление износа', function($sheet)use($report) {
                $depreciations = $report ->depreciations()->get(['number','name','carrying_amount','sum','residual_value']);
                $sheet->fromArray(array(
                    array('Инвертарный номер','Наименование','Балансовая стоимость', 'Начисленный износ', 'Остаточная стоимость'),
                ), null, 'A1', false, false);
                $sheet->fromModel($depreciations,null,'A1', false, false);
            });
            $excel->sheet('Списание', function($sheet)use($report) {
                $decommissions = $report ->decommissions()->get(['number','name','carrying_amount','sum','date','type']);
                $sheet->fromArray(array(
                    array('Инвертарный номер','Наименование','Балансовая стоимость', 'Сумма списания', 'Дата списания', 'Вид списания'),
                ), null, 'A1', false, false);
                $sheet->fromModel($decommissions,null,'A1', false, false);
            });
        })->store('xlsx', storage_path('excel/exports'), true);


        return Response::download($file['full']);
    }
    public function postOrganizationExcel(Request $request)
    {
        $organizations= \App\Models\Organization::where('type','client')->where('id','!=', 1)->get();
        $year= $request->input('year');
        $quarters= $request->input('quarters');
        if(isset($quarters[1])){
            $first = ' 1,';
        }
        else{
            $first='';
        }
        if(isset($quarters[2])){
            $second = ' 2,';
        }
        else{
            $second='';
        }
        if(isset($quarters[3])){
            $third = ' 3,';
        }
        else{
            $third='';
        }
        if(isset($quarters[4])){
            $fourth = ' 4';
        }
        else{
            $fourth='';
        }
        $filename = 'Сводный отчет за '.$year.' год'.$first.$second.$third.$fourth.' квартал';
        $file = Excel::create($filename, function($excel)use($organizations){
            $excel -> sheet('Сводный отчет',function($sheet)use($organizations){
                foreach($organizations as $organization){
                    $reports = \App\Models\Report::where('organization_id', '=', $organization->id)->where('state','=','accepted')->get();
                    if ($reports->count()){
                        $maxYear= \App\Models\Report::where('organization_id', '=', $organization->id)->where('state','=','accepted') -> max('year');
                        $maxQuarter = \App\Models\Report::where('organization_id', '=', $organization->id)->where(function($query)use($maxYear){
                            $query->where('year','=', $maxYear)
                            ->where('state','=','accepted');
                          })->max('quarter');
                        $report = \App\Models\Report::where('organization_id', '=', $organization->id)->where(function($query)use($maxYear,$maxQuarter) {
                            $query->where('year','=', $maxYear)
                                ->where('quarter','=', $maxQuarter);
                        })->first();
                        $data[] = array($organization->short_name,$report->report_total_carrying_amount, $report->report_wearout_value,$report->decommission_carrying_amount,$report->report_total_residual_value);
                    }
                    else{
                        $data[]=array($organization->short_name,$organization->org_carrying_amount,0,0,$organization->org_residual_value);
                    }
                }
                $sheet->fromArray(array(
                    array('Организация','Балансовая стоимость','Начисленный износ', 'Сумма списания', 'Остаточная стоимость'),
                ), null, 'A1', false, false);

                $sheet->fromModel($data,null,'A1', false, false);
            });
        })->store('xlsx', storage_path('excel/exports'), true);
        return Response::download($file['full']);
    }
}
