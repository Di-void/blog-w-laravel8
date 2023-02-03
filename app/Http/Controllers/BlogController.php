<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index () {
        return view('blog-posts.blog');
    }
    public function create () {
        return view('blog-posts.create-blog-post');
    }

    public function show () {
        return view('blog-posts.single-blog');
    }
}
