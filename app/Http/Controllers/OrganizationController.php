<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;
use App\Models;
use Yajra\Datatables\Datatables;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization=Auth::user()->organization;
        return View::make('organization',['organization' => $organization]);
    }
    public function getAdminOrganizations(){
        $organizations= \App\Models\Organization::all();
        $datatables = Datatables::of($organizations)
        ->addColumn('action',function($organization){
            return 'ХАХА';
        });
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('organization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public  function postCalcSumsFirstEnter($id){
        $sum_org_movables_carrying_amount=0;
        $sum_org_value_movables_carrying_amount=0;
        $sum_org_buildings_carrying_amount=0;
        $sum_org_parcels_carrying_amount=0;
        $sum_org_movables_residual_value=0;
        $sum_org_value_movables_residual_value=0;
        $sum_org_buildings_residual_value=0;
        $sum_org_cars_carrying_amount = 0;
        $sum_org_cars_residual_value = 0;
        $user=\App\Models\Organization::find($id)->user;
        $documents=\App\Models\User::find($user->id)-> documents;
        foreach ($documents as $document){
            $type=$document->os_type;
            if($type =='movables'){
                $sum_org_movables_carrying_amount=$sum_org_movables_carrying_amount+$document->doc_carrying_amount;
                $sum_org_movables_residual_value=$sum_org_movables_residual_value+$document->doc_residual_value;
            }
            if($type =='value_movables'){
                $sum_org_value_movables_carrying_amount=$sum_org_value_movables_carrying_amount+$document->doc_carrying_amount;
                $sum_org_value_movables_residual_value=$sum_org_value_movables_residual_value+$document->doc_residual_value;
            }
            if ($type == 'car') {
                $sum_org_cars_carrying_amount = $sum_org_cars_carrying_amount + $document->doc_carrying_amount;
                $sum_org_cars_residual_value = $sum_org_cars_residual_value + $document->doc_residual_value;
            }
            if($type=='buildings'){
                $sum_org_buildings_carrying_amount = $sum_org_buildings_carrying_amount+$document->doc_carrying_amount;
                $sum_org_buildings_residual_value=$sum_org_buildings_residual_value+$document->doc_residual_value;
            }
            if($type=='parcels'){
                $sum_org_parcels_carrying_amount=$sum_org_parcels_carrying_amount+$document->doc_carrying_amount;
            }
        }
        $organization_id = $user->organization_id;
        $organization=\App\Models\Organization::find($organization_id);
        $organization->org_movables_carrying_amount=$sum_org_movables_carrying_amount;
        $organization->org_value_movables_carrying_amount=$sum_org_value_movables_carrying_amount;
        $organization->org_cars_carrying_amount = $sum_org_cars_carrying_amount;
        $organization->org_buildings_carrying_amount=$sum_org_buildings_carrying_amount;
        $organization->org_parcels_carrying_amount=$sum_org_parcels_carrying_amount;
        $organization->org_movables_residual_value=$sum_org_movables_residual_value;
        $organization->org_value_movables_residual_value=$sum_org_value_movables_residual_value;
        $organization->org_buildings_residual_value=$sum_org_buildings_residual_value;
        $organization ->org_cars_residual_value = $sum_org_cars_residual_value;
        $organization->org_carrying_amount=$organization->org_movables_carrying_amount+$organization->org_value_movables_carrying_amount+$organization->org_buildings_carrying_amount+$organization->org_parcels_carrying_amount + $organization -> org_cars_carrying_amount ;
        $organization->org_residual_value=$organization->org_movables_residual_value+$organization->org_value_movables_residual_value+$organization->org_buildings_residual_value+$organization ->org_cars_residual_value;
        $organization->save();
        return redirect()->back();
    }
}
