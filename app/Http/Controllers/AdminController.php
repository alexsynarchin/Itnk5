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


}
