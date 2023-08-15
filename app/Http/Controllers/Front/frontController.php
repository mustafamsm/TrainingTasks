<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use App\Models\Silder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class frontController extends Controller
{
    public function index(){

      $books=Book::latest()->take(4)->get();
        return view('front.index',compact('books'));
    }
}
