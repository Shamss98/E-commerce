<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('frontend.categories.index', [
            'categories' => $categories,
        ]);
    }
    public function show($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)
            ->with(['products' => function ($query) {
                $query->where('status', 1);
            }])
            ->firstOrFail();

        return view('frontend.categories.show', compact('category'));
    }
}
