<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PagesController;
use \App\Http\Controllers\BlogController;
use \App\Http\Controllers\ContactController;

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

// To welcome page
Route::get('/', [PagesController::class, 'index'])->name('pages.index');
// To blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
// To single blog page
Route::get('/blog/single-blog-post', [BlogController::class, 'show'])->name('blog.show');
// To about page
Route::get('/about', function() {
   return view('about');
})->name('about');
// To contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
