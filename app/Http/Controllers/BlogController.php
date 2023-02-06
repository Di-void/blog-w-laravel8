<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index (Request $request) {
        if($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('body', 'like', '%' . $request->search . '%')->latest()->get();
        } else {
            $posts = Post::latest()->get();
        }

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

    public function edit(Post $post) {
        if(auth()->user()->id !== $post->user->id) {
            abort(403);
        }

        return view('blog-posts.edit-blog-post', compact('post'));
    }

    public function update(Request $request, Post $post) {
        if(auth()->user()->id !== $post->user->id) {
            abort(403);
        }
        $request->validate([
            "title" => 'required',
            "image" => 'required | image',
            "body" => 'required',
        ]);

        $title = $request->input('title');
        $postId = $post->id;
        $slug = Str::slug($title, '-') . "-" . $postId;
        $body = $request->input('body');

        //File upload
        $imagePath = 'storage/' . $request->file('image')->store('postImages','public');


        $post->title = $title;
        $post->slug = $slug;
        $post->body = $body;
        $post->image_path = $imagePath;

        // Save to database
        $post->save();

        return redirect()->back()->with('status', 'Post edited Successfully');
    }

//    public function show ($slug) {
//        $post = Post::where('slug', $slug)->first();
//        return view('blog-posts.single-blog', compact('post'));
//    }

    // Using Route Model Binding
    public function show(Post $post) {
        return view('blog-posts.single-blog', compact('post'));
    }

    public function delete(Post $post) {
        $post->delete();
        return redirect()->back()->with('status', 'Post delete Successfully');
    }
}
