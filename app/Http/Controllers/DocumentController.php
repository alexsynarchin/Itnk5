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
    public function create()
    {
        return View::make('document.create');
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
        // Если такого документа нет, то вернем пользователю ошибку 404 - Не найдено
        if (!$document) {
            App::abort(404);
        }
        return View::make('document/view', array(  'document' => $document ));
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
        return View::make('document.edit', array('document' => $document));
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
                return Redirect::to('documents');
                break;
            case 'value_movables':
                foreach($document->items as $item){
                    $variable=\App\Models\Item::find($item->id)->variable();
                    $variable->delete();
                }
                $document->items()->delete();
                $document->delete();
                return Redirect::to('documents');
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
                return Redirect::to('documents');
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
                return Redirect::to('documents');
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
                return Redirect::to('documents');
                break;
        }
    }
}
