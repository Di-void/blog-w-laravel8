<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PagesController;
use \App\Http\Controllers\BlogController;
use \App\Http\Controllers\ContactController;
use \App\Http\Controllers\CategoryController;

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
// To create blog post
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
// To single blog page
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
// To edit single blog post
Route::get('/blog/{post}/edit', [BlogController::class, 'edit'])->name('blog.edit');
// To update single blog post
Route::put('/blog/{post}', [BlogController::class, 'update'])->name('blog.update');
// To delete single blog post
Route::delete('/blog/{post}', [BlogController::class, 'destroy'])->name('blog.destroy');
// To store blog post to database
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
// To about page
Route::get('/about', function() {
   return view('about');
})->name('about');
// To contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// To store user message from contact Page
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Category Resource controller
Route::resource('/categories', CategoryController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
