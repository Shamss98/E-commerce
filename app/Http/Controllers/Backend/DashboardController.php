<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $usersCount = \App\Models\User::count();

        $productPerMonth = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $productData = [];
        $cumulative = [];
        $sum = 0;

        for ($i = 1; $i <= 12; $i++) {
            $count = $productPerMonth[$i] ?? 0;

            $productData[] = $count;

            $sum += $count;
            $cumulative[] = $sum;
        }
        return view('dashboard', [
            'productsCount' => $productsCount,
            'categoriesCount' => $categoriesCount,
            'usersCount' => $usersCount,
            'productData' => $productData,
            'cumulative' => $cumulative,
            'months' => $months


        ]);
    }
}
