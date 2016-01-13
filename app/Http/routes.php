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
Route::get('firstEnter',[
    'middleware' => 'auth',
    'uses' => 'DocumentController@firstEnter'
]);
Route::group(['prefix' => 'documents', 'middleware' => 'auth'], function(){
    Route::get('/', [
        'as' => 'documents',
        'uses' => 'DocumentController@index'
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
    'uses' => 'DashboardController@items'
]);
Route::get('organization',[
    'middleware' => 'auth',
    'as' => 'organization',
    'uses' => 'OrganizationController@index'
]);
Route::get('profile',[
    'middleware' => 'auth',
    'as' => 'profile',
 function(){
    return View::make('profile');
}]);
// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
//Controllers Routes
Route::controller('items', 'ItemController',[
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);
