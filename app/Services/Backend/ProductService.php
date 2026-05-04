<?php

namespace App\Services\Backend;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductService
{
    public function createProduct(array $data)
    {
        // dd($data);
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;
        return Product::create($data);
    }
    public function updateProduct(Product $product, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $slug = Str::slug($data['name']);
            $originalSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }
        return $product->update($data);
    }
}
