<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models;
use View;

class ReportController extends Controller
{
    public function create($id)
    {
        $organization=\App\Models\Organization::find($id);
        return View::make('report.create',compact('organization'));
    }
    public function store(Request $request, $id)
    {

    }
}
