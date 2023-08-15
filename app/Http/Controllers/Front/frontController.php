<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use App\Models\Silder;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class frontController extends Controller
{
    public function index(){

      $books=Book::latest()->take(4)->get();
      $categorys=Category::all();
        return view('front.index',compact('books','categorys'));
    }
}
