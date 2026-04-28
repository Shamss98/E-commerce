<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    public static function generateSlug($name)
{
    $slug = Str::slug($name);
    $originalSlug = $slug;
    $count = 1;

    while (self::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    return $slug;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
