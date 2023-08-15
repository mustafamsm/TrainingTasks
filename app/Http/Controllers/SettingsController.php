<?php

namespace App\Http\Controllers;

use App\Models\Setting;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.settings.index');
        
    }
  
    public function store(Request $request)
    {
       dd($request->all());
      
    }


}
