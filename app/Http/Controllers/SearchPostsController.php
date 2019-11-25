<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchPostsController extends Controller
{
    public function index(Request $request) {
        $posts = Post::filterPosts();
        return view('posts.search', compact('posts'));
    }
}
