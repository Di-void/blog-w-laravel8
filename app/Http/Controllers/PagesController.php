<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
//        print_r(route('products'));
        $posts = Post::latest()->take(4)->get();
        return view('welcome', compact('posts'));
    }
}
