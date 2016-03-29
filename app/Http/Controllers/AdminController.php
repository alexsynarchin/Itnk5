<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models;
use View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.index');
    }
    public function organization($id)
    {
        $organization=\App\Models\Organization::find($id);
        $user=\App\Models\Organization::find($id)->user;
        $documents=\App\Models\User::find($organization->user->id)->documents;
        $reports=$organization->reports;
        return View::make('admin.organization', compact('organization','reports','documents'));
    }
    public function documentCreate($id)
    {
        $user_id=$id;
        return View::make('admin.document.create', ['user_id'=> $user_id] );
    }
    public function documentStore($id)
    {
        $document = \App\Models\Document::create(Input::all());
        $user=\App\Models\User::find($id);
        $organization=$user->organization;
        $user->organization->last_document_number++;
        $user->organization->save();
        $document->document_number=$user->organization->last_document_number;
        $document->user_id = $id;
        $document->document_type='residues_entering';
        $document->save();
        return Redirect::action('AdminController@organization', [$user->organization->id]);
    }
    public function documentEdit($id)
    {
        $document = \App\Models\Document::find($id);
        return View::make('admin.document.edit', array('document' => $document));
    }
    public function documentUpdate(Request $request, $id)
    {
        $document=\App\Models\Document::find($id);
        $document->document_date = Input::get('document_date');
        $document->actual_date = Input::get('actual_date');
        $document->save();
        $user=\App\Models\User::find($document->user_id);
        return Redirect::action('AdminController@organization', [$user->organization_id]);
    }
    public  function documentShow($id)
    {
        $document = \App\Models\Document::find($id);
        // Если такого документа нет, то вернем пользователю ошибку 404 - Не найдено
        if (!$document) {
            App::abort(404);
        }
        return View::make('admin.document.show', array(  'document' => $document ));
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
public function residueStore($id){
    $organization = \App\Models\Organization::find($id);
    $residue = $organization ->residue;
    if(isset($residue)){

    }
    else{
        $residue = new \App\Models\Residue;
        $residue->organization_id = $id;
        $residue ->state = 'not_accepted';
        $residue -> save();
    }
    return redirect() ->back();
}

}
