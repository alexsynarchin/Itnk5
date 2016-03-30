<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('index');
});
Route::get('home', [
    'middleware'=>'auth',
    'as' => 'home',
    'uses' => 'DashboardController@index'
]);
Route::get('documents',[
    'middleware' => 'auth',
    'uses' => 'DocumentController@index'
]);
Route::get('reports',[
    'middleware' => 'auth',
    'uses' => 'ReportController@index',
    'as' => 'reports'
]);
Route::group(['prefix' => 'report/{id}', 'middleware' => 'auth'], function(){
    Route::get('/', [
        'as' => 'report.show',
        'uses' => 'ReportController@show'
    ]);
    Route::get('purchase', [
       'as' => 'report.purchase',
       'uses' => 'ReportController@purchase'
           ]);
    Route::group(['prefix' => 'depreciation', 'middleware' => 'auth'], function(){
        Route::get('/',[
            'as' => 'report.depreciation',
            'uses' => 'ReportController@depreciation'
        ]);
        Route::get('create',[
            'as' => 'depreciation.create',
            'uses' => 'DepreciationController@create'
        ]);
        Route::post('/',[
            'as' => 'depreciation.store',
            'uses' => 'DepreciationController@store'
        ]);
        Route::get('edit',[
            'as' => 'depreciation.store',
            'uses' => 'DepreciationController@edit'
        ]);
        Route::patch('/',[
            'as' => 'depreciation.update',
            'uses' => 'DepreciationController@update'
        ]);
        Route::get('destroy',[
            'as' => 'depreciation.delete',
            'uses' => 'DepreciationController@destroy'
        ]);
    });
    Route::get('decommission', [
        'as' => 'report.decommission',
        'uses' => 'ReportController@decommission'
    ]);
});
//Inspector
Route::group(['prefix' => 'inspector', 'middleware' => 'auth'], function(){
    Route::get('/',[
        'as' => 'inspector.index',
        'uses' => 'InspectorController@index'
    ]);
    Route::group(['prefix' =>'organization/{id}'],function(){
        Route::get('/',[
            'as' => 'inspector.show.organization',
            'uses' => 'InspectorController@showOrganization'
        ]);
    });
});
Route::get('items',[
    'middleware' => 'auth',
    'as' => 'items',
    'uses' => 'ItemController@index'
]);
Route::get('organization',[
    'middleware' => 'auth',
    'as' => 'organization',
    'uses' => 'OrganizationController@index'
]);
Route::get('profile',[
    'middleware' => 'auth',
    'as' => 'profile',
    'uses' => 'UserController@index']);
//Document Restful
Route::group(['middleware' => 'auth'],
    function()
    {
        //Документы ввода остатков
        Route::get('residues_entering',[
            'as' => 'residues_entering',
            'uses' => 'DocumentController@residues_entering'
        ]);
        Route::get('document/{id}/destroy',
                [
                    'as' => 'document.delete',
                    'uses' => 'DocumentController@destroy'
                ]);
        Route::resource('document', 'DocumentController');
        Route::get('document/{document_type}/create',[
            'as' => 'document.create',
            'uses' => 'DocumentController@create'
        ]);
        Route::get('report/{id}/{document_type}/create',[
            'as' => 'report.document.create',
            'uses' => 'DocumentController@reportCreate'
        ]);
        Route::controller('document', 'DocumentController');
        //Основные средства
        Route::get('{id}/item/create',[
            'as' => 'item.create',
            'uses' => 'ItemController@create'
        ]);
        Route::post('item/{id}',[
            'as' =>'item.store',
            'uses' => 'ItemController@store'
        ]);
        Route::get('item/{id}',[
            'as' =>'item.show',
            'uses' => 'ItemController@show'
        ]);
        Route::get('item/destroy/{id}',[
            'as' => 'item.destroy',
            'uses' => 'ItemController@destroy'
        ]);
        Route::get('item/{id}/edit',[
            'as' => 'item.edit',
            'uses' => 'ItemController@edit'
        ]);
        Route::patch('item/{id}', [
            'as' => 'item.update',
            'uses' => 'ItemController@update'
        ]);
        Route::controller('items' ,'ItemController',[
            'getDocumentItems' => 'document.items',
            'getItemsData' => 'items.data'
        ]);
        Route::resource('organization', 'OrganizationController');
        Route::controller('organizations', 'OrganizationController',[
            'getAdminOrganizations' =>'admin.organizations'
        ]);
        //Admin
        Route::get('admin',[
            'as' => 'admin.index',
            'uses' => 'AdminController@index'
        ]);
        Route::get('admin/organization/{id}',[
            'as' => 'admin.organization',
            'uses' => 'AdminController@organization'
        ]);
        Route::get('admin/{id}/document/create',[
            'as' => 'admin.document.create',
            'uses' => 'AdminController@documentCreate'
        ]);
        Route::post('admin/{id}/document',[
            'as' => 'admin.document.store',
            'uses' => 'AdminController@documentStore'
        ]);
        Route::get('admin/document/{id}/edit',[
                'as' => 'admin.document.edit',
                'uses' => 'AdminController@documentEdit'
            ]);
        Route::patch('admin/{id}/document',[
            'as' => 'admin.document.update',
            'uses' => 'AdminController@documentUpdate'
        ]);
        Route::get('admin/document/{id}',[
            'as' => 'admin.document.show',
            'uses' => 'AdminController@documentShow'
        ]);
        Route::controller('admin', 'AdminController');
        //Reports Admin
        Route::post('report/{id}',[
            'as' => 'report.store',
            'uses' => 'ReportController@store'
        ]);
        //Residues entering
        Route::post('residue/{id}',[
            'as' => 'residue.store',
            'uses' => 'AdminController@residueStore'
        ]);
        //Inspector
        Route::controller('inspector', 'InspectorController', [
            'getOrganizations' => 'inspector.organizations'
        ]);
        Route::controller('report','ReportController');
        Route::controller('depreciation', 'DepreciationController',[
            'getReportDepreciation' => 'report.depreciation.items'
        ]);
    });
// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');


