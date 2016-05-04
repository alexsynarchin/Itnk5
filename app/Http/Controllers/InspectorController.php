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
use DB;

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
        Excel::create('Filename', function($excel) {

        })->export('xls');
        return redirect()->back();
        /*$report=\App\Models\Report::find($id);
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
                $sheet->fromArray(array(
                    array('Инвертарный номер','Наименование','Балансовая стоимость', 'Код ОКОФ', 'Остаточная стоимость'),
                ), null, 'A1', false, false);
                $row =2;
                foreach($items as $item) {
                    $sheet->row($row,[$item->number, $item->name, $item->carrying_amount, $item->okof != 0 ? $item->okof: 'Земельный участок',isset($item->variable->residual_value) ? $item->variable->residual_value: 0]);
                    $row++;
                }
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
        })->store('xls', storage_path('excel/exports'), true);


       return Response::download($file);*/
    }
    public function postOrganizationExcel(Request $request)
    {
        $ids = [1,27];
        $organizations= \App\Models\Organization::where('type','client')->whereNotIn('id', $ids)->get();
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

        $file = Excel::create($filename, function($excel)use($organizations,$year,$quarters){
            $excel->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $excel -> sheet('Сводный отчет',function($sheet)use($organizations,$year,$quarters){
                $min =min($quarters);
                $iterations = count($quarters);
                $sheet->setMergeColumn(array(
                    'columns' => array('A','B','C','D'),
                    'rows' => array(
                        array(1,2)
                    )
                ));
                $sheet->row(1,["№", "Организация","ИНН", "Балансовая стоимость"]);
                $sheet ->setWidth('B',45);
                $sheet->setWidth('C', 13);
                $sheet->getStyle('A')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
                $sheet->setWidth('D', 22);
                if($iterations == 1){
                    $number=1;
                    $row=3;
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->mergeCells('E1:H1');
                    $sheet->setCellValue('E1', $min.' квартал');
                    $sheet->mergeCells('I1:I2');
                    $sheet->setWidth('G', 23);
                    $sheet->setWidth('H', 23);
                    $sheet->setWidth('I', 23);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'E2', false, false);
                    $sheet->setCellValue('I1','Остаточная стоимость');
                    $sheet->cells('A1:I2', function($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('middle');
                    });
                    foreach ($organizations as $organization){
                        $report=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,$min)->first();
                        $start=[$number, $organization->short_name,$organization->inn,isset($report->report_total_carrying_amount) ?  $report->report_total_carrying_amount:0];
                        $middle=$this->middle($report);
                        $end=[isset($report->report_wearout_residual_value) ? $report->report_wearout_residual_value : 0];
                        $sheet->row($row,array_merge($start,$middle,$end));
                        $row++;
                        $sheet->row($row,array('','Особоценное движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Автомобили',''));
                        $row++;
                        $sheet->row($row,array('','Движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Здания и сооружения',''));
                        $row++;
                        $sheet->row($row,array('','Земельные участки',''));
                        $row++;
                        $number++;
                    }
                }
                if($iterations == 2 ){
                    $number=1;
                    $row=3;
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('I')->setAutoSize(true);
                    $sheet->mergeCells('E1:H1');
                    $sheet->mergeCells('I1:L1');
                    $sheet->setCellValue('E1', $min.' квартал');
                    $sheet->setCellValue('I1', ($min+1).' квартал');
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    $sheet->setWidth('J', 15);
                    $sheet->setWidth('K', 15);
                    $sheet->setWidth('L', 15);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'E2', false, false);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'I2', false, false);
                    $sheet->mergeCells('M1:M2');
                    $sheet->setWidth('M', 23);
                    $sheet->setCellValue('M1','Остаточная стоимость');
                    $sheet->cells('A1:M2', function($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('middle');
                    });
                    foreach ($organizations as $organization){
                        $report=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,$min)->first();
                        $report1=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+1))->first();
                        $start=[$number, $organization->short_name,$organization->inn,isset($report->report_total_carrying_amount) ?  $report->report_total_carrying_amount:0];
                        $middle=$this->middle($report);
                        $middle1=$this->middle($report1);
                        $end=[isset($report1->report_wearout_residual_value) ? $report1->report_wearout_residual_value : 0];
                        $sheet->row($row,array_merge($start,$middle,$middle1,$end));
                        $row++;
                        $sheet->row($row,array('','Особоценное движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Автомобили',''));
                        $row++;
                        $sheet->row($row,array('','Движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Здания и сооружения',''));
                        $row++;
                        $sheet->row($row,array('','Земельные участки',''));
                        $row++;
                        $number++;
                    }
                }
                if($iterations == 3 ){
                    $number=1;
                    $row=3;
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('I')->setAutoSize(true);
                    $sheet->getColumnDimension('M')->setAutoSize(true);
                    $sheet->mergeCells('E1:H1');
                    $sheet->mergeCells('I1:L1');
                    $sheet->mergeCells('M1:P1');
                    $sheet->setCellValue('E1', $min.' квартал');
                    $sheet->setCellValue('I1', ($min+1).' квартал');
                    $sheet->setCellValue('M1', ($min+2).' квартал');
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    $sheet->setWidth('J', 15);
                    $sheet->setWidth('K', 15);
                    $sheet->setWidth('L', 15);
                    $sheet->setWidth('N', 15);
                    $sheet->setWidth('O', 15);
                    $sheet->setWidth('P', 15);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'E2', false, false);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'I2', false, false);
                    $sheet->setCellValue('M2','Статус');
                    $sheet->setCellValue('N2','Износ');
                    $sheet->setCellValue('O2','Приобретение');
                    $sheet->setCellValue('P2','Списание');
                    $sheet->mergeCells('Q1:Q2');
                    $sheet->setWidth('Q', 23);
                    $sheet->setCellValue('Q1','Остаточная стоимость');
                    $sheet->cells('A1:Q2', function($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('middle');
                    });
                    foreach ($organizations as $organization){
                        $report=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,$min)->first();
                        $report1=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+1))->first();
                        $report2=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+2))->first();
                        $start=[$number, $organization->short_name,$organization->inn,isset($report->report_total_carrying_amount) ?  $report->report_total_carrying_amount:0];
                        $middle=$this->middle($report);
                        $middle1=$this->middle($report1);
                        $middle2=$this->middle($report2);
                        $end=[isset($report2->report_wearout_residual_value) ? $report2->report_wearout_residual_value : 0];
                        $sheet->row($row,array_merge($start,$middle,$middle1,$middle2,$end));
                        $row++;
                        $sheet->row($row,array('','Особоценное движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Автомобили',''));
                        $row++;
                        $sheet->row($row,array('','Движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Здания и сооружения',''));
                        $row++;
                        $sheet->row($row,array('','Земельные участки',''));
                        $row++;
                        $number++;
                    }
                }
                if($iterations == 4 ){
                    $number=1;
                    $row=3;
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('I')->setAutoSize(true);
                    $sheet->getColumnDimension('M')->setAutoSize(true);
                    $sheet->getColumnDimension('Q')->setAutoSize(true);
                    $sheet->mergeCells('E1:H1');
                    $sheet->mergeCells('I1:L1');
                    $sheet->mergeCells('M1:P1');
                    $sheet->mergeCells('Q1:T1');
                    $sheet->setCellValue('E1', $min.' квартал');
                    $sheet->setCellValue('I1', ($min+1).' квартал');
                    $sheet->setCellValue('M1', ($min+2).' квартал');
                    $sheet->setCellValue('Q1', ($min+3).' квартал');
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    $sheet->setWidth('J', 15);
                    $sheet->setWidth('K', 15);
                    $sheet->setWidth('L', 15);
                    $sheet->setWidth('N', 15);
                    $sheet->setWidth('O', 15);
                    $sheet->setWidth('P', 15);
                    $sheet->setWidth('R', 15);
                    $sheet->setWidth('S', 15);
                    $sheet->setWidth('T', 15);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'E2', false, false);
                    $sheet->fromArray(array(
                        array('Статус','Износ','Приобретение','Списание'),
                    ), null, 'I2', false, false);
                    $sheet->setCellValue('M2','Статус');
                    $sheet->setCellValue('N2','Износ');
                    $sheet->setCellValue('O2','Приобретение');
                    $sheet->setCellValue('P2','Списание');
                    $sheet->setCellValue('Q2','Статус');
                    $sheet->setCellValue('R2','Износ');
                    $sheet->setCellValue('S2','Приобретение');
                    $sheet->setCellValue('T2','Списание');
                    $sheet->mergeCells('U1:U2');
                    $sheet->setWidth('U', 23);
                    $sheet->setCellValue('U1','Остаточная стоимость');
                    $sheet->cells('A1:U2', function($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('middle');
                    });
                    foreach ($organizations as $organization){
                        $report=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,$min)->first();
                        $report1=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+1))->first();
                        $report2=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+2))->first();
                        $report3=DB::table('reports')->whereOrganization_idAndYearAndQuarter($organization->id,$year,($min+3))->first();
                        $start=[$number, $organization->short_name,$organization->inn,isset($report->report_total_carrying_amount) ?  $report->report_total_carrying_amount:0];
                        $middle=$this->middle($report);
                        $middle1=$this->middle($report1);
                        $middle2=$this->middle($report2);
                        $middle3=$this->middle($report3);
                        $end=[isset($report3->report_wearout_residual_value) ? $report3->report_wearout_residual_value : 0];
                        $sheet->row($row,array_merge($start,$middle,$middle1,$middle2,$middle3,$end));
                        $row++;
                        $sheet->row($row,array('','Особоценное движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Автомобили',''));
                        $row++;
                        $sheet->row($row,array('','Движимое имущество',''));
                        $row++;
                        $sheet->row($row,array('','Здания и сооружения',''));
                        $row++;
                        $sheet->row($row,array('','Земельные участки',''));
                        $row++;
                        $number++;
                    }
                }
            });
        })->store('xlsx', storage_path('excel/exports'), true);
        return Response::download($file['full']);
    }
    public function middle($report){
        return [isset($report->state) ? \App\Models\Report::$report_state[$report->state] : '',isset($report->report_wearout_value) ? $report->report_wearout_value : 0,isset($report->report_carrying_amount) ? $report->report_carrying_amount : 0,isset($report->decommission_carrying_amount)? $report->decommission_carrying_amount : 0];
    }
}
