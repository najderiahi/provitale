<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $categories = Category::all();
        return view('auth.home', compact('categories'));
    }

    public function categories() {
        return view('auth.categories');
    }
}
