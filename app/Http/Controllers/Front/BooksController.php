<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    public function index(Request $request){
        $books=Book::where(function ($q)use($request){
            return $q->when($request->search,function($query)use($request){
                return $query->where('name_ar','like','%'.$request->search.'%')
                ->orWhere('name_en','like','%'.$request->search.'%');
            });

        })
        
        ->latest()->get();
        

        return view('front.books',compact('books'));
    }
}
