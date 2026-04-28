<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->image,
            $product->name,
            $product->category->name,
            $product->price,
            $product->stock,
            $product->status,
            $product->slug,
            $product->description,
            $product->created_at,

        ];
    }

    public function heading(): array
    {
        return [
            'ID',
            'Image',
            'Name',
            'Category',
            'Price',
            'Stock',
            'Status',
            'Slug',
            'Description',
            'Created At',
        ];
    }
}
