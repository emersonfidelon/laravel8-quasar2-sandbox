<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::with('sub_categories')->paginate(3);
        return response()->json($categories, 200);
    }

    public function show(Category $category) {
        return response()->json($category, 200);
    }

    public function store(Request $request) {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category) {
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function delete(Category $category) {
        $category->delete();
        return response()->json(null, 204);
    }
}
