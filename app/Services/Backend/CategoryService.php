<?php

namespace App\Services\Backend;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function createCategory(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }
    public function updateCategory(Category $category, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $category->name) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $category->update($data);
    }
}
