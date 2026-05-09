<?php

namespace App\Services\Backend;

use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductService
{
    public function createProduct(array $data)
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;
        $product = Product::create($data);

        if ($product->stock > 0) {
            InventoryMovement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'quantity' => $product->stock,
                'user_id' => Auth::id()
            ]);
        }

        return $product;
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
        $oldStock = $product->stock;

        $product->update($data);

        $newStock = $product->stock;
        $difference = $newStock - $oldStock;



        if ($difference != 0) {
            InventoryMovement::create([
                'product_id' => $product->id,
                'type' => $difference > 0 ? 'in' : 'out',
                'quantity' => abs($difference),
                'user_id' => Auth::id()
            ]);
        }

        if (
    $oldStock > $product->min_stock &&
    $newStock <= $product->min_stock
) {
    $admin = User::where('role', 'admin')->first();

    $admin->notify(new LowStockNotification($product));
}





        return $product;
    }
}
