<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    public function index(){
        $books=Book::latest()->get();
        

        return view('front.books',compact('books'));
    }
}
