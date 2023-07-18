<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $category_count=Category::all()->count();
        $book_count=Book::all()->count();
        return view('dashboard.app',compact('category_count','book_count'));
    }
}
