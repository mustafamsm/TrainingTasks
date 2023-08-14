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
      
        // return Setting::all()->pluck('value','key')->toArray();
        return view('dashboard.settings.index');
        
    }
    public function getAll(){

        $group=Setting::all();
    
        return DataTables::of($group)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return $btn = '

                <button  type="button"
                class="btn btn-info  btn-sm editModalBTn"

                data-id="' . $row->id . '"
                ><i class="fa fa-pencil" aria-hidden="true"></i>  '  . __('site.edit') . '</button>

                <button ajax_id="' . $row->id . '" type="button"
                class="btn btn-danger delete_btn btn-sm"

                >' . __('site.delete') . '</button>
                <button   type="button"

                class="btn btn-success showBtn btn-sm"
                data-id="' . $row->id . '"

                >' . __('site.show') . '</button>


                ';
        })->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups=Setting::select('group')->distinct()->get();
        
        $modalContent = View::make('dashboard.settings.AddModal',['groups'=>$groups])->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
              
              'key'=>'required|string|max:255',
              'value'=>'required|string|max:255',
              'group'=>'required|string|max:255|exists:settings,group',
         ]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
