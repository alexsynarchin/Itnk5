<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Yajra\Datatables\Datatables;
use App\Models;
use View;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('items');
    }
    public  function getItemsData(Request $request)
    {
        $id = $request->get('id');
        $items= \App\Models\User::find($id) -> items;
        $datatables = Datatables::of($items)
            ->addColumn('action',function ($item) {
                return '<a href="/item/'.$item->id.'" class="actions icons"><i class="fa fa-eye"></i></a><a href="/item/'.$item->id.'/edit" class="actions icons"><i class="fa fa-pencil-square-o"></i></a><a href="/item/destroy/'.$item->id.'" class="actions icons"><i class="fa fa-trash"></i></a>';
            });
        return $datatables->make(true);
    }
    public function getDocumentItems(Request $request)
    {
        $id=$request->get('document_id');
        $document=\App\Models\Document::find($id);

        $items = \App\Models\Item::where('document_id','=', $id);
        $datatables = Datatables::of($items)
        ->addColumn('action',function ($item) {
            return '<a href="/item/'.$item->id.'" class="actions icons"><i class="fa fa-eye"></i></a><a href="/item/'.$item->id.'/edit" class="actions icons"><i class="fa fa-pencil-square-o"></i></a><a href="/item/destroy/'.$item->id.'" class="actions icons"><i class="fa fa-trash"></i></a>';
        });
        return $datatables->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $document=\App\Models\Document::find($id);
        return View::make('item.create',['document' => $document]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $document=\App\Models\Document::find($id);
        $type=$document->os_type;
        if(($type=='movables')||($type=='value_movables')){
            $item = new \App\Models\Item;
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            //$item -> os_view=Input::get('os_view');
            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item -> document_id = $id;
            $item->save();
            $variable = new \App\Models\Variable;
            $variable -> exploitation_date = Input::get('exploitation_date');
            $variable -> residual_value = Input::get('residual_value');
            $variable -> monthly_rate = Input::get('monthly_rate');
            $variable -> useful_life = Input::get('useful_life');
            $item->variable()->save($variable);
        }
        if($type=='car'){
            $item = new \App\Models\Item;
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');

            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item -> document_id = $id;
            $item->save();
            $variable = new \App\Models\Variable;
            $variable -> exploitation_date = Input::get('exploitation_date');
            $variable -> residual_value = Input::get('residual_value');
            $variable -> monthly_rate = Input::get('monthly_rate');
            $variable -> useful_life = Input::get('useful_life');
            $item->variable()->save($variable);
            $car = new \App\Models\Car;
            $car -> brand = Input::get('brand');
            $car -> model = Input::get('model');
            $car -> manufacture_year = Input::get('manufacture_year');
            $car -> vin = Input::get('vin');
            $car -> kpp = Input::get('kpp');
            $car -> engine = Input::get('engine');
            $car -> power = Input::get('power');
            $car -> color = Input::get('color');
            $car -> car_type = Input::get('car_type');
            $item->car()->save($car);
        }

        if($type=='buildings'){
            $item = new \App\Models\Item;
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            //$item -> os_view=Input::get('os_view');
            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item -> document_id = $id;
            $item->save();
            $variable = new \App\Models\Variable;
            $variable -> exploitation_date = Input::get('exploitation_date');
            $variable -> residual_value = Input::get('residual_value');
            $variable -> monthly_rate = Input::get('monthly_rate');
            $variable -> useful_life = Input::get('useful_life');
            $item->variable()->save($variable);
            $building=new \App\Models\Building;
            $building->appointment=Input::get('appointment');
            $building->wall_material=Input::get('wall_material');
            $building->date_construction=Input::get('date_construction');
            $building->floors=Input::get('floors');
            $item->building()->save($building);
            $address=new \App\Models\Address;
            $address->state=Input::get('state');
            $address->district=Input::get('district');
            $address->city=Input::get('city');
            $address->street=Input::get('street');
            $address->building_number=Input::get('building_number');
            $address->building_number_2=Input::get('building_number_2');
            $item->address()->save($address);
        }
        if($type=='parcels'){
            $item=new \App\Models\Item;
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item -> document_id = $id;
            $item->save();
            $parcel=new \App\Models\Parcel;
            $parcel->cadastral=Input::get('cadastral');
            $parcel->assigning_land=Input::get('assigning_land');
            $parcel->area=Input::get('area');
            $item->parcel()->save($parcel);
            $address=new \App\Models\Address;
            $address->state=Input::get('state');
            $address->district=Input::get('district');
            $address->city=Input::get('city');
            $address->street=Input::get('street');
            $address->building_number=Input::get('building_number');
            $address->building_number_2=Input::get('building_number_2');
            $item->address()->save($address);
        }
        return Redirect::action('DocumentController@show',[$item->document_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=\App\Models\Item::find($id);
        $document=\App\Models\Item::find($id)->document;
        $type=$item->document->os_type;
        switch($type){
            case 'movables'||'value_movables':
                $variable=\App\Models\Item::find($id)->variable();
                return View::make('item.show', array('item'=>$item,'document'=>$document, 'variable'=>$variable));
                break;
            case 'buildings':
                $variable=\App\Models\Item::find($id)->variable();
                $building=\App\Models\Item::find($id)->building();
                $address=\App\Models\Address::find($id)->address();
                return View::make('item.show', array('item'=>$item,'document'=>$document, 'building'=>$building, 'address'=>$address, 'variable'=>$variable));
                break;
            case 'parcels':
                $parcel=\App\Models\Item::find($id)->parcel;
                $address=\App\Models\Address::find($id)->address();
                return View::make('item.show', array('item'=>$item,'document'=>$document, 'parcel'=>$parcel, 'address'=>$address));
                break;

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item= \App\Models\Item::find($id);
        $document= \App\Models\Document::find($item->document_id);
        $type=$document->os_type;
        switch($type){
            case 'movables'||'value_movables':
                $variable= \App\Models\Item::find($id)->variable();
                return View::make('item.edit', array('item' => $item,'document'=>$document, 'variable'=>$variable));
                break;
            case 'car':
                $variable= \App\Models\Item::find($id)->variable();
                $car =  \App\Models\Car::find($id)->car();
                return View::make('item.edit', array('item' => $item,'document'=>$document, 'variable'=>$variable, 'car' => $car));
                break;
            case 'buildings':
                $variable= \App\Models\Item::find($id)->variable();
                $building= \App\Models\Item::find($id)->building();
                $address= \App\Models\Address::find($id)->address();
                return View::make('item.edit', array('item' => $item,'document'=>$document, 'building'=>$building,'variable'=>$variable,'address'=>$address));
                break;
            case 'parcels':
                $parcel= \App\Models\Item::find($id)->parcel();
                $address= \App\Models\Address::find($id)->address();
                return View::make('item.edit', array('item' => $item,'document'=>$document, 'parcel'=>$parcel,'address'=>$address));
                break;
        }
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
        $item=\App\Models\Item::find($id);
        $document=\App\Models\Item::find($id)->document;
        $type=$item->document->os_type;
        if(($type=='movables')||($type=='value_movables')){
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            $item -> os_view=Input::get('os_view');
            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item->save();
            $variable=\App\Models\Item::find($id)->variable;
            $item->variable -> exploitation_date = Input::get('exploitation_date');
            $item->variable -> residual_value = Input::get('residual_value');
            $item->variable -> monthly_rate = Input::get('monthly_rate');
            $item->variable -> useful_life = Input::get('useful_life');
            $item->variable->save();
            return Redirect::action('DocumentController@show',[$item->document_id]);
        }
        if($type=='car'){
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            //$item -> os_view=Input::get('os_view');
            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item->save();
            $variable=\App\Models\Item::find($id)->variable();
            $item->variable -> exploitation_date = Input::get('exploitation_date');
            $item->variable -> residual_value = Input::get('residual_value');
            $item->variable -> monthly_rate = Input::get('monthly_rate');
            $item->variable -> useful_life = Input::get('useful_life');
            $item->variable->save();
            $car = \App\Models\Item::find($id)->car();
            $item->car -> brand = Input::get('brand');
            $item->car -> model = Input::get('model');
            $item->car -> manufacture_year = Input::get('manufacture_year');
            $item->car -> vin = Input::get('vin');
            $item->car -> kpp = Input::get('kpp');
            $item->car -> engine = Input::get('engine');
            $item->car -> power = Input::get('power');
            $item->car -> color = Input::get('color');
            $item->car -> car_type = Input::get('car_type');
            $item->car->save();
            //return Redirect::action('DocumentController@show',[$item->document_id]);
            return redirect()->back();
        }
        if($type=='buildings'){
            $variable=\App\Models\Item::find($id)->variable();
            $building=\App\Models\Item::find($id)->building();
            $address=\App\Models\Item::find($id)->address();
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            $item -> os_view=Input::get('os_view');
            $item -> okof=Input::get('okof');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item->save();
            $variable -> exploitation_date = Input::get('exploitation_date');
            $item->variable -> residual_value = Input::get('residual_value');
            $item->variable -> monthly_rate = Input::get('monthly_rate');
            $item->variable -> useful_life = Input::get('useful_life');
            $item->variable->save();
            $item->building->appointment=Input::get('appointment');
            $item->building->wall_material=Input::get('wall_material');
            $item->building->date_construction=Input::get('date_construction');
            $item->building->floors=Input::get('floors');
            $item->building->save();
            $item->address->state=Input::get('state');
            $item->address->district=Input::get('district');
            $item->address->city=Input::get('city');
            $item->address->street=Input::get('street');
            $item->address->building_number=Input::get('building_number');
            $item->address->building_number_2=Input::get('building_number_2');
            $item->address->save();
            return Redirect::action('DocumentController@show',[$item->document_id]);
        }
        if($type=='parcels'){
            $parcel=\App\Models\Item::find($id)->parcel();
            $address=\App\Models\Item::find($id)->address();
            $item -> name=Input::get('name');
            $item -> os_date=Input::get('os_date');
            $item -> number=Input::get('number');
            $item->carrying_amount=Input::get('carrying_amount');
            $item->financing_source=Input::get('financing_source');
            $item->additional_field=Input::get('additional_field');
            $item->save();
            $item->parcel->cadastral=Input::get('cadastral');
            $item->parcel->assigning_land=Input::get('assigning_land');
            $item->parcel->area=Input::get('area');
            $item->parcel->save();
            $item->address->state=Input::get('state');
            $item->address->district=Input::get('district');
            $item->address->city=Input::get('city');
            $item->address->street=Input::get('street');
            $item->address->building_number=Input::get('building_number');
            $item->address->building_number_2=Input::get('building_number_2');
            $item->address->save();
            return Redirect::action('DocumentController@show',[$item->document_id]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=\App\Models\Item::find($id);
        $document=\App\Models\Item::find($id)->document;
        $type=$document->os_type;
        switch($type){
            case 'buildings':
                $variable=\App\Models\Item::find($id)->variable();
                $building=\App\Models\Item::find($id)->building();
                $address=\App\Models\Item::find($id)->address();
                $variable->delete();
                $address->delete();
                $building->delete();
                $item->delete();
                //return Redirect::action('DocumentController@show', [$item->document->id]);
                return redirect()->back();
                break;
            case 'car':
                $variable=\App\Models\Item::find($id)->variable();
                $variable->delete();
                $car =\App\Models\Item::find($id)->car();
                $car->delete();
                $item->delete();
                //return Redirect::action('DocumentController@show', [$item->document->id]);
                return redirect()->back();
                break;
            case 'parcels':
                $parcel=\App\Models\Item::find($id)->parcel();
                $address=\App\Models\Item::find($id)->address();
                $address->delete();
                $parcel->delete();
                $item->delete();
                //return Redirect::action('DocumentController@show', [$item->document->id]);
                return redirect()->back();
                break;
            case 'movables'||'value_movables':
                $variable=\App\Models\Item::find($id)->variable();
                $variable->delete();
                $item->delete();
                //return Redirect::action('DocumentController@show', [$item->document->id]);
                return redirect()->back();
                break;
        }
    }
}
