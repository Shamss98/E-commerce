<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    public function index()
    {
        $categories = \App\Models\Category::all();
        $products = \App\Models\Product::where('status', 1)->latest()->paginate(48);
        $productsDiscounted = \App\Models\Product::where('status', 1)->where('discount', '!=', 0)->latest()->take(12)->get();
        $products_latest = \App\Models\Product::where('status', 1)->latest()->take(12)->get();
        return view('home', [
            'categories' => $categories,
            'products' => $products,
            'productsDiscounted' => $productsDiscounted,
            'products_latest' => $products_latest,
        ]);
    }
}
