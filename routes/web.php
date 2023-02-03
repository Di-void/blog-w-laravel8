<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PagesController;

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
Route::get('/', [PagesController::class, 'index']);

// To Blog Page
Route::get('/blog', [BlogController::class, 'index']);
// TO single blog post
Route::get('/blog/single-blog-post', [BlogController::class, 'show']);

// Pattern is integer
//Route::get('/products/{id}', [PagesController::class, 'show'])->where('id', '[0-9]+');
