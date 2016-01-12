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
Route::get('documents', [
    'middleware' => 'auth',
    'as' => 'documents',
    'uses' => 'DocumentController@index'
]);
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
// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
//Controllers Routes
Route::controller('items', 'ItemController',[
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);
