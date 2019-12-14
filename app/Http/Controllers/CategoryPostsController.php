<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryPostsController extends Controller
{
    public function index()
    {
        $posts = Category::getPosts();
        return view('posts.index', compact('posts'));
    }

    public function show(Category $category) {
        $posts = $category->posts()->orderBy('created_at', 'DESC')->paginate();

        return view('categories.show', compact('posts', 'category'));
    }
}
