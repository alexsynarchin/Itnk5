<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index() {
        $organization =Auth::user()->organization;
        $reports= $organization->reports;
        if ($reports->count()){
            return View::make('report.index',compact('reports'));
        }
        else{
            return View::make('report.empty');
        }
    }

    public function store($id)
    {
        $organization = \App\Models\Organization::find($id);
        $reports = $organization ->reports;
        if ($reports->count()){
            $maxYear= \App\Models\Report::where('organization_id', '=', $id) -> max('year');
            $maxQuarter = \App\Models\Report::where('organization_id', '=', $id)->where('year','=', $maxYear)->max('quarter');
            if($maxQuarter == 4)
            {
                $year = ++$maxYear;
                $report= new \App\Models\Report;
                $report -> year = $year;
                $report -> quarter = 1;
                $report -> organization_id = $id;
                $report ->state = 'not_accepted';
                $report->save();
                return Redirect::action('AdminController@organization', [$id]);
            }
            else{
                $quarter = $maxQuarter+1;
                $report= new \App\Models\Report;
                $report -> year = $maxYear;
                $report -> quarter = $quarter;
                $report -> organization_id = $id;
                $report ->state = 'not_accepted';
                $report->save();
                return Redirect::action('AdminController@organization', [$id]);
            }
        }
        else{
            $report= new \App\Models\Report;
            $report -> year = 2015;
            $report -> quarter = 4;
            $report -> organization_id = $id;
            $report ->state = 'not_accepted';
            $report->save();
            return Redirect::action('AdminController@organization', [$id]);
        }
     }
    public function show(){

    }
}
