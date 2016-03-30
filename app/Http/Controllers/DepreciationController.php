<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use App\Models;
use View;

class DepreciationController extends Controller
{
    public function create($id)
    {
        $report= \App\Models\Report::find($id);
        return View::make('report.depreciation.create',compact('report'));
    }
    public function store(Request $request, $id)
    {
        $depreciation =\App\Models\Depreciation::create($request->all());
        $depreciation -> report_id = $id;
        $depreciation -> save();
        return Redirect::action('ReportController@depreciation' , $id);
    }
    public function edit($id)
    {
        $depreciation = \App\Models\Depreciation::find($id);
        $report = \App\Models\Report::find($depreciation->report_id);
        return View::make('report.depreciation.edit',compact('depreciation', 'report'));
    }
    public function update(Request $request, $id)
    {
        $depreciation=\App\Models\Depreciation::find($id);
        $depreciation -> name = $request -> name;
        $depreciation -> number = $request -> number;
        $depreciation -> carrying_amount = $request -> carrying_amount;
        $depreciation -> sum = $request -> sum;
        $depreciation -> residual_value = $request -> residual_value;
        $depreciation -> save();
        return Redirect::action('ReportController@depreciation' , $depreciation->report_id);
    }
    public function destroy($id)
    {
        $depreciation=\App\Models\Depreciation::find($id);
        $depreciation ->delete();
        return redirect()->back();
    }
    public function getReportDepreciation(Request $request)
    {
        $id=$request->get('report_id');
        $depreciations = \App\Models\Depreciation::where('report_id','=', $id);
        $datatables = Datatables::of($depreciations)
            ->addColumn('action',function ($depreciation) {
                return '<a href="/report/'.$depreciation->id.'/depreciation/edit" class="actions icons"><i class="fa fa-pencil-square-o"></i></a><a href="/report/'.$depreciation->id.'/depreciation/destroy" class="actions icons"><i class="fa fa-trash"></i></a>';
            });
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
                    $depreciation = new \App\Models\Depreciation();
                    $name = iconv("Windows-1251", "utf-8", $data[1]);
                    $depreciation->name = $name;
                    $depreciation -> number = $data[2];
                    $carrying_amount=$data[2];
                    $carrying_amount=str_replace(",",".",$carrying_amount);
                    $carrying_amount=str_replace(" ","",$carrying_amount);
                    $depreciation -> carrying_amount = $carrying_amount;
                    $sum=$data[3];
                    $sum=str_replace(",",".",$carrying_amount);
                    $sum=str_replace(" ","",$carrying_amount);
                    $depreciation -> sum = $sum;
                    $sum=$data[3];
                    $sum=str_replace(",",".",$carrying_amount);
                    $sum=str_replace(" ","",$carrying_amount);
                    $depreciation -> sum = $sum;
                    $residual_value=$data[4];
                    $sum=str_replace(",",".",$residual_value);
                    $sum=str_replace(" ","",$residual_value);
                    $depreciation -> residual_value = $residual_value;
                    $depreciation ->report_id = $id;
                    $depreciation ->save();
                }
            }
        }
        return redirect()->back();
    }
}
