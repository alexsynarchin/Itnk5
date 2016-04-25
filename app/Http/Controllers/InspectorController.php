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
            $excel->sheet('Сводные данные по отчету', function($sheet)use($report) {
                $sheet->mergeCells('A1:E1');
                $sheet->fromArray(array(
                    array('Итоговые суммы по отчету'),
                    array('Балансовая стоимость', 'Начисленный износ', 'Сумма списания', 'Остаточная стоимость'),
                    array($report->report_total_carrying_amount, $report->report_wearout_value, $report->decommission_carrying_amount, $report->report_total_residual_value)
                ), null, 'A2', false, false);
                array('');
                array('Сводные данные по прибретению');
            });


            $excel->sheet('Итоговые данные по отчету', function($sheet)use($report) {

                $sheet->fromArray(array(
                    array('Балансовая стоимость', 'Начисленный износ', 'Сумма списания', 'Остаточная стоимость'),
                    array($report->report_total_carrying_amount, $report->report_wearout_value, $report->decommission_carrying_amount, $report->report_total_residual_value)
                ), null, 'A1', false, false);
            });

        })->store('xlsx', storage_path('excel/exports'), true);


        return Response::download($file['full']);
    }
}
