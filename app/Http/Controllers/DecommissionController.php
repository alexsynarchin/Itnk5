<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use App\Models;
use View;

class DecommissionController extends Controller
{
    public function create($id)
    {
        $report= \App\Models\Report::find($id);
        return View::make('report.decommission.create',compact('report'));
    }
    public function store(Request $request, $id)
    {
        $decommission =\App\Models\Decommission::create($request->all());
        $decommission -> report_id = $id;
        $decommission -> save();
        return Redirect::action('ReportController@decommission' , $id);
    }

    public function edit($id)
    {
        $decommission = \App\Models\Decommission::find($id);
        $report = \App\Models\Report::find($decommission->report_id);
        return View::make('report.decommission.edit',compact('decommission', 'report'));
    }
    public function update(Request $request, $id)
    {
        $decommission=\App\Models\Decommission::find($id);
        $decommission -> name = $request -> name;
        $decommission -> number = $request -> number;
        $decommission -> carrying_amount = $request -> carrying_amount;
        $decommission -> sum = $request -> sum;
        $decommission -> date = $request -> date;
        $decommission -> type =$request -> type;
        $decommission -> save();
        return Redirect::action('ReportController@decommission' , $decommission->report_id);
    }
    public function destroy($id)
    {
        $decommission=\App\Models\Decommission::find($id);
        $decommission -> delete();
        return redirect()->back();
    }
    public function postDeleteAll($id)
    {
        $decommission = \App\Models\Decommission::where('report_id', $id) -> delete();
        return redirect() -> back();
    }
    public function getReportDecommission(Request $request)
    {
        $id=$request->get('report_id');
        $decommission = \App\Models\Decommission::where('report_id','=', $id);
        if(Auth::user() -> username == '1-0275071849') {
            $datatables = Datatables::of($decommission)->addColumn('decommission_type', function($decommission){return \App\Models\Decommission::$decommission_type[$decommission->type]; });
        }
        else{
            $datatables = Datatables::of($decommission)
                ->addColumn('action',function ($decommission) {
                    return '<a href="/report/'.$decommission->id.'/decommission/edit" class="actions icons"><i class="fa fa-pencil-square-o"></i></a><a href="/report/'.$decommission->id.'/decommission/destroy" class="actions icons"><i class="fa fa-trash"></i></a>';
                })->addColumn('decommission_type', function($decommission){return \App\Models\Decommission::$decommission_type[$decommission->type]; });
        }
        return $datatables->make(true);
    }
    public function postImport($id)
    {
        $report = \App\Models\Report::find($id);
        if(Input::hasFile('file')){
            $file=Input::file('file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/';
            Input::file('file')->move($destinationPath, $filename);
            $handle=fopen(public_path().'/uploads/'.$filename, "r");
            if ($handle !== FALSE){
                while (($data = fgetcsv($handle, 1000, ';')) !==FALSE){
                    $decommission = new \App\Models\Decommission();
                    $name = iconv("Windows-1251", "utf-8", $data[0]);
                    $decommission->name = $name;
                    $decommission -> number = $data[1];
                    $carrying_amount=$data[2];
                    $carrying_amount=str_replace(",",".",$carrying_amount);
                    $carrying_amount=str_replace(" ","",$carrying_amount);
                    $decommission -> carrying_amount = $carrying_amount;
                    $date = date("Y-m-d", strtotime($data[3]));
                    $decommission -> date = $date;
                    $decommission_type=$data[4];
                    $decommission_type=str_replace(" ","",$decommission_type);
                    switch ($decommission_type){
                        case 1:
                            $decommission->type = 'sale';
                            break;
                        case 2:
                            $decommission->type = 'gratuitous transfer';
                            break;
                        case 3:
                            $decommission->type = 'decommission';
                            break;
                        default:
                            $decommission->type = null;
                    }
                    $sum=$data[5];
                    $sum=str_replace(",",".",$sum);
                    $sum=str_replace(" ","",$sum);
                    $decommission -> sum = $sum;
                    $document = iconv("Windows-1251", "utf-8", $data[6]);
                    $decommission -> document = $document;
                    $decommission ->report_id = $id;
                    $decommission ->save();
                }
            }
        }
        return redirect()->back();
    }
}
