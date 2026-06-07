<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Backend\CategoryService;
use App\Traits\BulkActionTrait;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use BulkActionTrait;
    protected CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
public function index()
    {
        $categories = Category::with('products')->latest()->paginate(12);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request)
{
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $this->categoryService->createCategory($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
}
    public function show(int $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show', compact('category'));
    }

public function edit(Category $category)
{
    return view('dashboard.categories.edit', compact('category'));
}

    public function update(CategoryRequest $request, Category $category)
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $this->categoryService->updateCategory($category, $data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function bulkDelete()
    {
    $message = $this->ApplyBulkAction(request(), Category::class);
    return redirect()->route('admin.categories.index')->with('success', $message);
    }

}
