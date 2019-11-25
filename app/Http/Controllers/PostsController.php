<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'destroy']);
    }

    public function index() {
        return Post::filterAll()->with('category')->paginate();
    }

    public function store(StorePostRequest $request) {
        $post = Post::storeFromRequestData($request->only('category', 'description'), $request->file('image'));
        return redirect('/home');
    }

    public function update(Post $post, Request $request) {
        if($request->has('description')) {
            $request->validate([
                'description' => 'required',
            ]);
            $post->description = $request->get('description');
        }

        if($request->has('category')) {
            $request->validate([
                'category' => 'required|exists:categories,id',
            ]);
            $post->category_id = $request->get('category');
        }

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|max:53248',
            ]);
            $post->storeImage($request->file('image'));
        }

        $post->save();
        return redirect()->back();
    }

    public function destroy(Post $post) {
        Storage::disk('public')->delete($post->image_location);
        $post->delete();
        return response([], 202);
    }
}
