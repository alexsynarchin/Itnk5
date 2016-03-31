<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
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
}
