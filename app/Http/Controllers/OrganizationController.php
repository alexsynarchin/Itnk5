<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input;


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
            return 'Действие';
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
        $organization = new \App\Models\Organization;
        $organization -> full_name = Input::get('full_name');
        $organization -> short_name = Input::get('short_name');
        $organization -> inn = Input::get('inn');
        $organization -> kpp = Input::get('kpp');
        $organization -> legal_address = Input::get('legal_address');
        $organization -> fact_address = Input::get('fact_address');
        $organization -> boss_position = Input::get('boss_position');
        $organization -> fio = Input::get('fio');
        $organization -> date = Input::get('date');
        $organization -> contract_number = Input::get('contract_number');
        $organization -> operate_foundation = Input::get('operate_foundation');
        $organization -> rs = Input::get('rs');
        $organization -> ks = Input::get('ks');
        $organization -> ls = Input::get('ls');
        $organization -> bank = Input::get('bank');
        $organization -> bik = Input::get('bik');
        $organization -> phone = Input::get('phone');
        $organization -> email = Input::get('email');
        $organization -> last_document_number = 1;
        $organization->save();
        $user = new \App\Models\User;
        $user ->first_name = Input::get('first_name');
        $user ->last_name = Input::get('last_name');
        $user ->surname = Input::get('surname');
        $user ->username = Input::get('username');
        $user ->password = bcrypt(Input::get('password'));
        $organization->user()->save($user);
        return redirect()->back();
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
