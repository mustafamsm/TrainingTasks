<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
Route::group(
    [
        'as'=>'dashboard.',
        'prefix'=>'dashboard'
    ],
    function(){
        Route::get('/',[DashboardController::class,'index'])->name('index');
        Route::resource('/categories',CategoryController::class);
        Route::get('/CategoriesgetAll',[CategoryController::class,'getCategoryDatatable'])->name('categories.getAll');
        Route::post('/category/ajaxupdate/{id}',[CategoryController::class,'ajaxUpdate'])->name('categories.ajaxUpdate');


        Route::resource('/books',BookController::class);
        Route::get('/books/trached/all',[BookController::class,'trached'])->name('books.trached');
        Route::get('/BookgetAll',[BookController::class,'getBookDatatable'])->name('books.getAll');
        Route::get('/BookgetAllTrached',[BookController::class,'getTrachedDatatable'])->name('books.getTrachedDatatable');
        Route::delete('/{id}/book/force-delete',[BookController::class,'forceDelete'])->name('books.forceDelete');
        Route::post('/{id}/book/restore', [BookController::class,'restore'])->name('books.restore');
        Route::post('/books/restore-all', [BookController::class,'restoreAll'])->name('books.restore-all');

    }
);
}); 

