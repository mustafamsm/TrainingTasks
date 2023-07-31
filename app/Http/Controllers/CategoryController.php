<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

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
                  
                data-name="' . $row->name . '"  
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
                data-name="' . $row->name . '"  
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
            'name' => 'required|min:3|max:55',
            'image' => 'required|image',
            'status' => 'required|in:0,1'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('category-images', $name, [
                'disk' => 'public'
            ]);
        }

        Category::create([
            'name' => $request->name,
            'image' => $name,
            'status' => $request->status
        ]);
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
            'name' => 'required|min:3|max:55',
            'image' => 'image',
        ]);
        $category = Category::findOrFail($id);
        $old_iamge = $category->image;
        $data = $request->except('image');
        $new_image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $new_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('category-images', $new_image, [
                'disk' => 'public'
            ]);
        }
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);
        if ($old_iamge && $new_image) {
            Storage::disk('public')->delete('category-images/' . $old_iamge);
        }

        return redirect()->route('dashboard.categories.index')->with('success', __('site.updated_successfully'));
    }

    public function ajaxUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:55',
            'image' => 'image',
        ]);
        $category = Category::findOrFail($id);
        $old_iamge = $category->image;

        $data = $request->except('image');


        $new_image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $new_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('category-images', $new_image, [
                'disk' => 'public'
            ]);
        }
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);
        if ($old_iamge && $new_image) {
            Storage::disk('public')->delete('category-images/' . $old_iamge);
        }
        return response()->json(['success' => true, 'message' => __('site.updated_successfully')]);
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
