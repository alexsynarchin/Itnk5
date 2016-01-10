<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $organization = Auth::user() -> organization;
        return \View::make('home', ['organization' => $organization]);
    }
    public function items() {
        $items = \App\Models\Item::all();
        return \View::make('items')->with('items',$items);
    }
}
