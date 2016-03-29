<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models;
use View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Auth::user() -> documents;
        return View::make('document.index', ['documents'=>$documents]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residues_entering()
    {
        $documents = Auth::user() -> documents;
        $organization=Auth::user() -> organization;
        $residue = $organization -> residue;
        return View::make('document.residues_entering', compact('documents','organization','residue'));
    }
    public function create($document_type)
    {
        $document_title=\App\Models\Document::documentTitle($document_type);
        return View::make('document.create',compact('document_type','document_title'));
    }
    public  function reportCreate($id, $document_type){
        $report_id=$id;
        $document_title=\App\Models\Document::documentTitle($document_type);
        return View::make('document.create',compact('document_type','document_title','report_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document= \App\Models\Document::create($request->all());
        $document -> user_id = Auth::user() -> id;
        $user = \App\Models\User::find($document -> user_id);
        $organization = \App\Models\User::find($document -> user_id) -> organization();
        $user->organization->last_document_number++;
        $user->organization->save();
		$document->document_number=$user->organization->last_document_number;
		$document->save();
       return Redirect::action('DocumentController@show', [$document->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = \App\Models\Document::find($id);
        $document_type=$document->document_type;
        $document_title=\App\Models\Document::documentTitle($document_type);
        // Если такого документа нет, то вернем пользователю ошибку 404 - Не найдено
        if (!$document) {
            App::abort(404);
        }
        return View::make('document.view', compact('document','document_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = \App\Models\Document::find($id);
        $document_type=$document->document_type;
        $document_title=\App\Models\Document::documentTitle($document_type);
        return View::make('document.edit', compact('document','document_title'));
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
        $document=\App\Models\Document::find($id);
        $document->document_date = Input::get('document_date');
        $document->actual_date = Input::get('actual_date');
        $document->save();
        return Redirect::action('DocumentController@show', [$document->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = \App\Models\Document::find($id);
        $type=$document->os_type;
        $items=\App\Models\Document::find($id)->items;
        switch($type){
            case 'movables':
                foreach($document->items as $item){
                    $variable= \App\Models\Item::find($item->id)->variable();
                    $variable->delete();
                }
                $document->items()->delete();
                $document->delete();
                return redirect()->back();
                break;
            case 'value_movables':
                foreach($document->items as $item){
                    $variable=\App\Models\Item::find($item->id)->variable();
                    $variable->delete();
                }
                $document->items()->delete();
                $document->delete();
                return redirect()->back();
                break;
            case 'car':
                foreach($document->items as $item){
                    $variable=\App\Models\Item::find($item->id)->variable();
                    $variable->delete();
                }
                foreach($document->items as $item){
                    $car=\App\Models\Item::find($item->id)->car();
                    $car->delete();
                }
                $document->items()->delete();
                $document->delete();
                return redirect()->back();
                break;
            case 'buildings':
                foreach($document->items as $item){
                    $variable=\App\Models\Item::find($item->id)->variable();
                    $variable->delete();

                }
                foreach($document->items as $item){
                    $building=\App\Models\Item::find($item->id)->building();
                    $building->delete();
                }
                foreach($document->items as $item){
                    $address=\App\Models\Item::find($item->id)->address();
                    $address->delete();
                }
                $document->items()->delete();
                $document->delete();
                return redirect()->back();
                break;
            case 'parcels':
                foreach($document->items as $item){
                    $parcel=\App\Models\Item::find($item->id)->parcel();
                    $address=\App\Models\Item::find($item->id)->address();
                    $address->delete();
                    $parcel->delete();
                }
                $document->items()->delete();
                $document->delete();
                return redirect()->back();
                break;
        }
    }
    public function postDocSave($id){
        $document=\App\Models\Document::find($id);
        $type=$document->os_type;
        $items=\App\Models\Document::find($document->id)->items;
        $sum_carrying_amount=0;
        $sum_residual_value=0;
        foreach($items as $item){
            if(isset($item->carrying_amount)){
                $sum_carrying_amount=$sum_carrying_amount+$item->carrying_amount;
            }
            else{
                $sum_carrying_amount=$sum_carrying_amount;
            }
            if($type!='parcels'){
                $variable=\App\Models\Item::find($item->id)->variable;
                if(isset($variable->residual_value)){
                    $sum_residual_value=$sum_residual_value+$variable->residual_value;
                }
                $sum_residual_value=$sum_residual_value;
            }
        }
        $document->doc_carrying_amount=$sum_carrying_amount;
        if($type!='parcels'){
            $document->doc_residual_value=$sum_residual_value;
        }
        $document->save();
        return redirect()->back();

    }
    public function postImport($id){
        $document = \App\Models\Document::find($id);
        $type=$document->os_type;
        if(Input::hasFile('file')){
            $file=Input::file('file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/';
            Input::file('file')->move($destinationPath, $filename);
            $handle=fopen(public_path().'/uploads/'.$filename, "r");
            if ($handle !== FALSE)
            {
                if(($type=='movables')||($type=='value_movables')){
                    while (($data = fgetcsv($handle, 1000, ';')) !==FALSE)
                    {
                        $item = new \App\Models\Item();
                        $name = iconv("Windows-1251", "utf-8", $data[0]);
                        $item->name = $name;
                        $item->number=$data[1];
                        $os_date = date("Y-m-d", strtotime($data[2]));
                        $item -> os_date=$os_date;
                        $okof=$data[5];
                        $okof = str_replace(" ","",$okof);
                        $item -> okof=$okof;
                        $carrying_amount=$data[6];
                        $carrying_amount=str_replace(",",".",$carrying_amount);
                        $carrying_amount=str_replace(" ","",$carrying_amount);
                        $item->carrying_amount=$carrying_amount;
                        $item->financing_source=1;
                        $item -> document_id = $id;
                        $item->save();
                        $variable = new \App\Models\Variable;
                        $exploitation_date = date("Y-m-d", strtotime($data[3]));
                        $variable -> exploitation_date = $exploitation_date;
                        $residual_value=$data[8];
                        $residual_value=str_replace(",",".",$residual_value);
                        $residual_value=str_replace(" ","",$residual_value);
                        $variable -> residual_value = $residual_value;
                        $monthly_rate=$data[10];
                        $monthly_rate=str_replace(",",".",$monthly_rate);
                        $variable -> monthly_rate = $monthly_rate;
                        $variable -> useful_life = $data[11];
                        $item->variable()->save($variable);
                    }
                }
                if($type=='car'){
                    while (($data = fgetcsv($handle, 2000, ';')) !==FALSE)
                    {
                        $item = new \App\Models\Item();
                        $name = iconv("Windows-1251", "utf-8", $data[0]);
                        $item->name = $name;
                        $item->number=$data[1];
                        $os_date = date("Y-m-d", strtotime($data[2]));
                        $item -> os_date=$os_date;
                        $okof=$data[5];
                        $okof = str_replace(" ","",$okof);
                        $item -> okof=$okof;
                        $carrying_amount=$data[6];
                        $carrying_amount=str_replace(",",".",$carrying_amount);
                        $carrying_amount=str_replace(" ","",$carrying_amount);
                        $item->carrying_amount=$carrying_amount;
                        $item->financing_source=1;
                        $item -> document_id = $id;
                        $item->save();
                        $variable = new \App\Models\Variable;
                        $exploitation_date = date("Y-m-d", strtotime($data[3]));
                        $variable -> exploitation_date = $exploitation_date;
                        $residual_value=$data[8];
                        $residual_value=str_replace(",",".",$residual_value);
                        $residual_value=str_replace(" ","",$residual_value);
                        $variable -> residual_value = $residual_value;
                        $monthly_rate=$data[10];
                        $monthly_rate=str_replace(",",".",$monthly_rate);
                        $variable -> monthly_rate = $monthly_rate;
                        $variable -> useful_life = $data[11];
                        $item->variable()->save($variable);
                        $car =  new \App\Models\Car;
                        $car -> brand = $data[12];
                        $car -> model = $data[13];
                        $manufacture_year = date("Y-m-d", strtotime($data[14]));
                        $car -> manufacture_year = $manufacture_year;
                        $vin = $data[15];
                        $vin = str_replace('"','',$vin);
                        $car -> vin = $vin;
                        $car -> kpp = $data[16];
                        $car -> engine = $data[17];
                        $car -> power = $data[18];
                        if(isset($data[19])){
                            $car -> color = $data[19];
                        }

                        $item->car()->save($car);
                    }
                }
                if($type=='buildings'){
                    while (($data = fgetcsv($handle, 1000, ';')) !==FALSE){
                        $item = new \App\Models\Item();
                        $name = iconv("Windows-1251", "utf-8", $data[0]);
                        $item->name = $name;
                        $item->number=$data[1];
                        $os_date = date("Y-m-d", strtotime($data[2]));
                        $item -> os_date=$os_date;
                        $okof=$data[5];
                        $okof = str_replace(" ","",$okof);
                        $item -> okof=$okof;
                        $carrying_amount=$data[6];
                        $carrying_amount=str_replace(",",".",$carrying_amount);
                        $carrying_amount=str_replace(" ","",$carrying_amount);
                        $item->carrying_amount=$carrying_amount;
                        $item->financing_source=1;
                        $item -> document_id = $id;
                        $item->save();
                        $variable = new \App\Models\Variable;
                        $exploitation_date = date("Y-m-d", strtotime($data[3]));
                        $variable -> exploitation_date = $exploitation_date;
                        $residual_value=$data[8];
                        $residual_value=str_replace(",",".",$residual_value);
                        $residual_value=str_replace(" ","",$residual_value);
                        $variable -> residual_value = $residual_value;
                        $monthly_rate=$data[10];
                        $monthly_rate=str_replace(",",".",$monthly_rate);
                        $monthly_rate=str_replace(" ","",$monthly_rate);
                        $variable -> monthly_rate = $monthly_rate;
                        $variable -> useful_life = $data[11];
                        $item->variable()->save($variable);
                        $building=new \App\Models\Building;
                        $appointment=iconv("Windows-1251", "utf-8", $data[12]);
                        $building->appointment=$appointment;
                        $wall_material=iconv("Windows-1251", "utf-8", $data[13]);
                        $building->wall_material=$wall_material;
                        $date_construction = date("Y-m-d", strtotime($data[14]));
                        $building->date_construction=$date_construction;
                        $building->floors=$data[15];
                        $item->building()->save($building);
                        $address=new \App\Models\Address;
                        $state=iconv("Windows-1251", "utf-8", $data[16]);
                        $address->state=$state;
                        $item->address()->save($address);
                    }
                }
                if($type=='parcels'){
                    while (($data = fgetcsv($handle, 1000, ';')) !==FALSE){
                        $item = new \App\Models\Item();
                        $name = iconv("Windows-1251", "utf-8", $data[0]);
                        $item->name = $name;
                        $item->number=$data[1];
                        $os_date = date("Y-m-d", strtotime($data[2]));
                        $item -> os_date=$os_date;
                        $carrying_amount=$data[3];
                        $carrying_amount=str_replace(",",".",$carrying_amount);
                        $carrying_amount=str_replace(" ","",$carrying_amount);
                        $item->carrying_amount=$carrying_amount;
                        $item->financing_source=1;
                        $item -> document_id = $id;
                        $item->save();
                        $parcel=new \App\Models\Parcel;
                        $parcel->cadastral=$data[5];
                        $assigning_land=iconv("Windows-1251", "utf-8", $data[6]);
                        $parcel->assigning_land=$assigning_land;
                        $parcel->area=$data[7];
                        $item->parcel()->save($parcel);
                        $address=new \App\Models\Address;
                        $state=iconv("Windows-1251", "utf-8", $data[8]);
                        $address->state=$state;
                        $state=iconv("Windows-1251", "utf-8", $data[8]);
                        $item->address()->save($address);
                    }
                }

                fclose($handle);
            }
        }
        return redirect()->back();
    }
}
