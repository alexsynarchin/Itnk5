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
Route::group(['prefix' => 'reports', 'middleware' => 'auth'], function(){
    Route::get('/', [
        function(){
            return View::make('reports');
        }
    ]);
    Route::get('purchase',
            function(){
                return View::make('documents.purchase');
            }
        );
    Route::get('depreciation',function(){
        return View::make('documents.depreciation');
    });
    Route::get('decommission', function(){
       return View::make('documents.decommission');
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
        Route::get('document/{id}/destroy',
                [
                    'as' => 'document.delete',
                    'uses' => 'DocumentController@destroy'
                ]);

        Route::resource('document', 'DocumentController');
        Route::controller('document', 'DocumentController');
        //Основные средства
        Route::get('document/{id}/item/create/',[
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
        Route::controller('organization', 'OrganizationController');
    }

);
// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');


