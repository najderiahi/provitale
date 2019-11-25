<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store', 'update']);
    }

    public function index() {
        return Category::paginate();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        Category::create(['name' => $request->get('name')]);
        return redirect()->back();
    }

    public function update(Request $request, Category $category) {
        if($request->has('name')) {
            $request->validate([
                'name' => 'required|unique:categories'
            ]);
            $category->name = $request->get('name');
        }
        $category->save();
        return redirect()->back();
    }

    public function destroy(Category $category) {
        $category->delete();
        return response()->json([], 202);
    }
}
