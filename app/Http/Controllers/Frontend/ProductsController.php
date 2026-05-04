<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InstallmentPlan;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(48);

        $count = Product::where('CREATED_AT', '>', now()->subDays(7))->where('status', 1)->count();
        return view('frontend.products.index', compact('products', 'count'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        $interestPlans = InstallmentPlan::get()->map(function ($plan) use ($product) {

            $price = $product->price;
            $discount = $product->discount ?? 0;

            // 1. apply discount first
            $discountedPrice = $price - ($price * $discount / 100);

            // 2. interest on discounted price
            $interest = ($discountedPrice * $plan->interest_rate) / 100;

            // 3. total
            $total = $discountedPrice + $interest;

            // 4. monthly
            $monthly = $total / $plan->months;

            $plan->discounted_price = $discountedPrice;
            $plan->total = $total;
            $plan->monthly = $monthly;

            return $plan;
        });




        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('slug', '!=', $product->slug)
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts', 'interestPlans',));
    }

    public function newProducts()
    {
        $products = Product::with('category')
            ->where('status', 1)
            ->latest()
            ->take(48)
            ->get();
        $count = Product::where('CREATED_AT', '>', now()->subDays(7))->where('status', 1)->count();


        return view('frontend.products.new', compact('products', 'count'));
    }
    public function search()
    {
        $query = request('q');

        $products = Product::with('category')
            ->where('status', 1)
            ->where(function ($q2) use ($query) {
                $q2->where('name', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhereHas('category', function ($q3) use ($query) {
                        $q3->where('name', 'like', "%$query%");
                    });
            })
            ->latest()
            ->paginate(8)
            ->appends(['q' => $query]);

        $count = Product::where('CREATED_AT', '>', now()->subDays(7))->where('status', 1)->count();
        return view('frontend.products.search', compact('products', 'count'));
    }
}
