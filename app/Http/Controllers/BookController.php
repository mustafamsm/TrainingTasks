<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{

    public function index()
    {
  

        $categories = Category::all();

        return view('dashboard.books.index', compact('categories'));
    }

    public function getBookDatatable()
    {

        $model  = Book::with('category');
        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('category', function (Book $book) {
                return $book->category->name;
            })->addColumn('action', function ($row) {

                return $btn = '
                    <button  type="button"
                    class="btn btn-info  btn-sm editModalBTn "
                  
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
            })
            ->rawColumns(['action', 'category'])
            ->setRowClass(function ($row) {
                return 'Row' . $row->id;
            })
            ->toJson();
    }
    public function create()
    {
        $categories = Category::all();
        $modalContent = View::make('dashboard.books.AddModal', compact('categories'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:155',
            'author' => 'required|string',
            'publication' => 'required|date',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'

        ]);

        Book::create($request->input());
        return response()->json(['success' => true, 'message' => __('site.added successfully')]);
    }



    public function show($id)
    {
        $book = Book::where('id',$id)->with('category')->first();
       
        $modalContent = View::make('dashboard.books.ShowModal', compact('book'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            'name' => 'required|min:3|max:155',
            'author' => 'required|string',
            'publication' => 'required|date',
            'description' => 'nullable|string',
            'price' => 'required|numeric', 
            'category_id' => 'required|exists:categories,id'

        ]);
        $book = Book::findOrFail($id);
        $book->update($request->input());
        return response()->json(['success' => true, 'message' => __('site.updated_successfully')]);
    }


    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'msg' => __('site.not_exist'),
                'status' => false,
            ]);
        }
        $book->delete();

        return response()->json([
            'msg' => __('site.deleted_successfully'),
            'status' => true,
            'id' => $id
        ]);
    }


    public function trached()
    {

        $categories = Category::all();

        return view('dashboard.books.trach', compact('categories'));
    }
    public function getTrachedDatatable()
    {

        $model = Book::with('category')->onlyTrashed();
        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('category', function (Book $book) {
                return $book->category->name;
            })->addColumn('action', function ($row) {
                return $btn = '
               

                <button ajax_id="' . $row->id . '" type="button"
                class="btn btn-danger delete_btn btn-sm"
                ><i class="fa fa-trash"></i>' . __('site.force-delete') . '</button> 


                <button ajax_id="' . $row->id . '" type="button"
                class="btn btn-primary restore_btn btn-sm"
                >
                <i class="fas fa-redo"></i>
                
                ' . __('site.restore') . '</button> 
                
                <button   type="button"
                data-toggle="modal" data-target="#modal-show"
                class="btn btn-success  btn-sm"
                data-author="' . $row->author . '" data-description="' . $row->description . '"
                data-name="' . $row->name . '" data-category_id="' . $row->category->name . '"
                data-price="' . $row->price . '" data-publication="' . $row->publication . '"
                >
                <i class="fas fa-eye"></i>
                ' . __('site.show') . '</button>
                ';
            })
            ->rawColumns(['action', 'category'])
            ->setRowClass(function ($row) {
                return 'Row' . $row->id;
            })
            ->toJson();
    }

    public function forceDelete($id)
    {
        $book = Book::where('id', $id)->withTrashed();
        if (!$book) {
            return response()->json([
                'msg' => __('site.not_exist'), 
                'status' => false,
            ]);
        }
        $book->forceDelete();

        return response()->json([
            'msg' => __('site.deleted_successfully'),
            'status' => true,
            'id' => $id
        ]);
    }
    public function restore($id)
    {
        $book = Book::where('id', $id)->withTrashed();
        if (!$book) {
            return response()->json([
                'msg' =>__('site.not_exist') ,  
                'status' => false,
            ]);
        }
        $book->restore();

        return response()->json([
            'msg' => __('site.restored_successfully'),
            'status' => true,
            'id' => $id
        ]);
    }
    public function restoreAll()
    {
        $books = Book::onlyTrashed();
        if (Book::onlyTrashed()->count() > 0) {
            $books = Book::onlyTrashed()->restore();
            return response()->json([
                'msg' => __('site.restored_successfully'),
                'status' => true,

            ]);
        }
        return response()->json([
            'msg' => __('site.cant_restore'),
            'status' => false,

        ]);
    }


    public function edit($id)
    {

        $book = Book::findOrFail($id);
        $categories = Category::all();
        // Use the view() method to render the Blade template and return it as HTML
        $modalContent = View::make('dashboard.books.EditModal', compact('book', 'categories'))->render();


        // Return the modal content as a JSON response
        return response()->json(['modalContent' => $modalContent]);
    }
}
