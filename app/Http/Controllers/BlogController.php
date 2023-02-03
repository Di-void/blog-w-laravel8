<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index () {
        $posts = Post::latest()->get();
        return view('blog-posts.blog', compact('posts'));
    }
    public function create () {
        return view('blog-posts.create-blog-post');
    }
    public function store (Request $request) {
        $request->validate([
            "title" => 'required',
            "image" => 'required | image',
            "body" => 'required',
        ]);

        $title = $request->input('title');
        $postId = Post::latest()->take(1)->first()->id + 1;
        $slug = Str::slug($title, '-') . "-" . $postId;
        $user_id = Auth::user()->id;
        $body = $request->input('body');

        //File upload
        $imagePath = 'storage/' . $request->file('image')->store('postImages','public');

        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->image_path = $imagePath;

        // Save to database
        $post->save();

        return redirect()->back()->with('status', 'Post Created Successfully');
    }

//    public function show ($slug) {
//        $post = Post::where('slug', $slug)->first();
//        return view('blog-posts.single-blog', compact('post'));
//    }

    // Using Route Model Binding
    public function show(Post $post) {
        return view('blog-posts.single-blog', compact('post'));
    }
}
