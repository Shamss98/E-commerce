<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Backend\ProductService;
use App\Traits\BulkActionTrait;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use BulkActionTrait;
    protected ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(8);
        return view('dashboard.products.index', compact('products'));
    }
    public function show(int $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('dashboard.products.show', compact('product'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $this->productService->createProduct($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $this->productService->updateProduct($product, $data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
    public function bulkDelete()
    {
        $message = $this->ApplyBulkAction(request(), Product::class);
        return redirect()->route('admin.products.index')->with('success', $message);
    }
    public function exportAllProducts()
    {
        return Excel::download(new ProductExport(), 'products.xlsx');
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

        return view('dashboard.products.search', compact('products'));
    }
    public function productCount()
    {
        $products = Product::with('category')
            ->select('id', 'name', 'stock', 'category_id', 'image', 'status', 'discount', 'category_id')
            ->latest()
            ->paginate(48);

        return view('dashboard.products.count', compact('products'));
    }
    public function decreaseQuantity($productId, $qty)
    {
        $product = Product::find($productId);
        if ($product->stock >= $qty) {
            $product->decrement('stock', $qty);
        } else {
            return redirect()->back()->with('error', 'Product quantity is not enough');
        }
    }
}
