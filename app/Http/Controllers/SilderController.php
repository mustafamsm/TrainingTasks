<?php

namespace App\Http\Controllers;

use App\Helpers\Image;
use App\Models\Silder;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SilderController extends Controller
{

    public function index()
    {
      return view('dashboard.silders.index');
    }

public function getAll(){
    $silders = Silder::all();
    return DataTables::of($silders)
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
    public function create()
    {
        $modalContent = View::make('dashboard.silders.AddModal')->render();
        return response()->json(['modalContent' => $modalContent]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'required|exists:temporary_files,folder',
            'status' => 'required|in:0,1|max:255',
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',

        ]);

        $silder = Silder::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'status' => $request->status,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => '',
        ]);
        $tempFile = TemporaryFile::where('folder', $request->image)->first();
        if($tempFile){
            Image::Image($request, $tempFile, 'silder-images', $silder);
        }
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $name = Str::random(20) . '.' . $file->getClientOriginalExtension();

        //     $path = $file->storeAs('silder-images', $name, [
        //         'disk' => 'public'
        //     ]);
        // }


        
        return response()->json(['success' => true, 'message' => __('site.added successfully')]);
    }


    public function show($id)
    {
        $silder = Silder::findOrFail($id);
        $modalContent = View::make('dashboard.silders.ShowModal', compact('silder'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $silder = Silder::findOrFail($id);
        $modalContent = View::make('dashboard.silders.EditModal', compact('silder'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }


    public function update(Request $request, $id)
    {


        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1|max:255',
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',

        ]);
        $silder = Silder::findOrFail($id);
        $old_image = $silder->image;
        $data=$request->except('image');
        $new_image=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $new_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('silder-images', $new_name, [
                'disk' => 'public'
            ]);
        }

        $silder->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete( $old_image);
        }

        return response()->json(['success' => true, 'message' => __('site.updated successfully')]);
    }
    public function ajaxUpdate(Request $request,$id){



        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1|max:255',
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',

        ]);
        $silder = Silder::findOrFail($id);
        $old_image = $silder->image;
        $data=$request->except('image');
        $new_image=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $new_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('silder-images', $new_name, [
                'disk' => 'public'
            ]);
        }

        $silder->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return response()->json(['success' => true, 'message' => __('site.updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $silder = Silder::find($id);

        if (!$silder) {
            return response()->json([
                'msg' => __('site.not_exist'),
                'status' => false,
            ]);
        }
        $silder->delete();
        if ($silder->image) {
            Storage::disk('public')->delete($silder->image);
        }

        return response()->json([
            'msg' => __('site.deleted_successfully'),
            'status' => true,
            'id' => $id
        ]);
    }
}
