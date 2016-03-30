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
}
