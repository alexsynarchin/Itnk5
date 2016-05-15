<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DashboardController extends Controller
{
    public function index(){
        if(Auth::user() -> username != '1-0275071849'){
            $organization = Auth::user() -> organization;
            return \View::make('home', ['organization' => $organization]);
        }
        else{
            return Redirect::action('InspectorController@index');
        }

    }
    public function items() {
        $items = \App\Models\Item::all();
        return \View::make('items')->with('items',$items);
    }
    public function help()
    {
        return view('help');
    }
    public function download($id)
    {
        $entry = \App\Models\OrgDoc::where('id',$id)->firstOrFail();
        $filepath =storage_path().'/app'.'/organizations/'.$entry->organization_id.'/orgDocs/'.$entry->filename;
        return response()->download($filepath, $entry->original_filename);
    }
}
