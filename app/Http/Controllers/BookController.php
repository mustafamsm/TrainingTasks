<?php

namespace App\Http\Controllers;

use App\Helpers\Image;
use App\Models\Book;
use App\Models\Category;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
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
                return $book->category->name_ar . ' | ' . $book->category->name_en;
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
            'name_ar' => 'required|min:3|max:155',
            'name_en' => 'required|min:3|max:155',
            'author' => 'required|string',
            'publication' => 'required|date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|exists:temporary_files,folder',

        ]);
       
        $book= Book::create($request->input());
        $tempFile = TemporaryFile::where('folder', $request->image)->first();
        if ($tempFile) {
            Image::Image($request,$tempFile,'book-images',$book);

            return response()->json(['success' => true, 'message' => __('site.added successfully')]);
       }
        return response()->json(['error' => true, 'message' => __('no image selected')]);

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
            'name_ar' => 'required|min:3|max:155',
            'name_en' => 'required|min:3|max:155',
            'author' => 'required|string',
            'publication' => 'required|date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'

        ]);
        $book = Book::findOrFail($id);
        $old_iamge = $book->image;
        $data = $request->except('image');

        if ($request->has('image')) {
            $tempFile = TemporaryFile::where('folder', $request->image)->first();
            if ($tempFile) {
                Image::Image($request,$tempFile,'book-images',$book);
            }
            Storage::disk('public')->delete('book-images/' . $old_iamge);

        }
        

        $book->update($data);
       
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

        $curan = LaravelLocalization::getCurrentLocale();

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
                data-author="' . $row->author . '"
                 data-description_ar="' . $row->description_ar . '"
                 data-description_en="' . $row->description_en . '"
                data-name_ar="' . $row->name_ar  .'"
                data-name_en="' . $row->name_en  .'"
                data-category_id="' .
                $row->category->name.

                  '"
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
