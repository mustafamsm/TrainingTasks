<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Silder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $category_count=Category::all()->count();
        $book_count=Book::all()->count();
        $silders=Silder::active()->date()->get();

        return view('dashboard.app',compact('category_count','book_count','silders'));
    }
}
