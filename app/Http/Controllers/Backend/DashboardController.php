<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'productsCount' => Product::count(),
            'categoriesCount' => Category::count(),
            'usersCount' => \App\Models\User::count(),
            'totalPrice' => Product::sum('price'),
            'totalStock' => Product::sum('stock'),

        ]);
    }
}
