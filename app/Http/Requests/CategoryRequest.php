<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
     $category = $this->route('category');

    return [
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('categories', 'name')->ignore($category->id),
        ],

        'slug' => [
            'required',
            'string',
            'max:255',
            Rule::unique('categories', 'slug')->ignore($category->id),
        ],

        'description' => 'nullable|string',

        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        'status' => 'required|boolean',
    ];
}
}
