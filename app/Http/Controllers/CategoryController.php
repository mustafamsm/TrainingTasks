<?php

namespace App\Http\Controllers;

use COM;
use App\Models\Book;
use App\Helpers\Image;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $c=Category::has('books')->get();
        // $c=Category::doesntHave('books')->get();

        return view('dashboard.categories.index');
    }

    public function getCategoryDatatable()
    {
        $model = Category::with('books');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('books', function (Category $category) {
                return $category->books->map(function (Book $book) {
                    return $book->name;
                });
            })->addColumn('action', function ($row) {
                return $btn = '
                <button  type="button"
                class="btn btn-info  btn-sm"
                data-toggle="modal" data-target="#modal-edit"
                  
                data-name_ar="' . $row->name_ar . '"  
                data-name_en="' . $row->name_en . '"  
                data-status="' . $row->status . '"
                data-image="' . $row->image . '"
                data-id="' . $row->id . '"
                >' . __('site.edit') . '</button>

                <button ajax_id="' . $row->id . '" type="button"
                class="btn btn-danger delete_btn btn-sm"
               
                >' . __('site.delete') . '</button> 

                <button   type="button"
                data-toggle="modal" data-target="#modal-show"
                class="btn btn-success  btn-sm"
                data-name_ar="' . $row->name_ar . '"  
                data-name_en="' . $row->name_en . '"  
                data-status="' . $row->status . '"
                data-image="' . $row->image . '"
                >' . __('site.show') . '</button>

                <button   type="button"
                data-toggle="modal" data-target="#modal-books"
                class="btn btn-info  btn-sm btn-book"
                data-id="' . $row->id . '"  
                 
                >' . __('site.books') . '</button>
                ';
            })
            ->rawColumns(['action', 'books'])
            ->setRowClass(function ($row) {
                return 'Row' . $row->id;
            })
            ->toJson();
    }
    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name_ar' => 'required|min:3|max:55',
            'name_en' => 'required|min:3|max:55',
            'image' => 'required',
            'status' => 'required|in:0,1'
        ]);

        $category=Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'image' => '',
            'status' => $request->status
        ]);

        $tempFile = TemporaryFile::where('folder', $request->image)->first();
        if($tempFile){
            Image::Image($request, $tempFile, 'category-images', $category);
        }
         

       
        return response()->json(['success' => true, 'message' => __('site.added successfully')]);
    }


    public function show($id)
    {

        $category = Category::where('id', $id)->first();
        $books = $category->books()->get();
        return  DataTables::Of($books)
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name_ar' => 'required|min:3|max:55',
            'name_en' => 'required|min:3|max:55',
             
        ]);
        $category = Category::findOrFail($id);
        $old_iamge = $category->image;
        $data = $request->except('image');
        
        if ($request->has('image')) {
            $tempFile = TemporaryFile::where('folder', $request->image)->first();
            if ($tempFile) {
                Image::Image($request,$tempFile,'category-images',$category);
            }
            Storage::disk('public')->delete('category-images/' . $old_iamge);

        }
        
       

        $category->update($data);
        

        return redirect()->route('dashboard.categories.index')->with('success', __('site.updated_successfully'));
    }

    public function ajaxUpdate(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|min:3|max:55',
            'name_en' => 'required|min:3|max:55',
             
        ]);
        $category = Category::findOrFail($id);
        $old_iamge = $category->image;
        $data = $request->except('image');
        
        if ($request->has('image')) {
            $tempFile = TemporaryFile::where('folder', $request->image)->first();
            if ($tempFile) {
                Image::Image($request,$tempFile,'category-images',$category);
            }
            Storage::disk('public')->delete('category-images/' . $old_iamge);

        }
        
       

        $category->update($data);
        

        return redirect()->route('dashboard.categories.index')->with('success', __('site.updated_successfully'));
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->books()->count() >  0) {
            return response()->json([
                'msg' => __('site.cant_delete_this_category_because_it_has_books') . '!!',
                'status' => false,
            ]);
        }
        if (!$category) {
            return response()->json([
                'msg' => __('site.not_exist'),
                'status' => false,
            ]);
        }
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete('category-images/' . $category->image);
        }

        return response()->json([
            'msg' => __('site.deleted_successfully'),
            'status' => true,
            'id' => $id
        ]);
    }
}
