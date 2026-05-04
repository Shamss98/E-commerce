@extends('backend._app')

@section('title', 'Products')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Products</h3>

            <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Product
            </a>

            <a href="{{ route('admin.products.exportAllProducts') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-file-earmark-excel"></i> Export All
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow rounded-4">
            <div class="card-body">

                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Bulk Actions -->
                <form action="{{ route('admin.products.bulkDelete') }}" method="POST">
                    @csrf

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex gap-2">
                            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm px-3">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>

                        <!-- Count Selected -->
                        <span id="selected-count" class="text-muted small">
                            0 selected
                        </span>

                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">

                            <thead class="table-light">
                                <tr class="text-uppercase small text-muted">
                                    <th>
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($products as $product)
                                    <tr>

                                        <!-- Checkbox -->
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{ $product->id }}"
                                                class="item-checkbox">
                                        </td>

                                        <td class="fw-bold text-secondary">
                                            #{{ $product->id }}
                                        </td>

                                        <!-- Image -->
                                        <td class="align-middle text-center">

                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="img-thumbnail shadow-sm"
                                                    style="width: 50px; height: 50px; object-fit: cover;"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('images/default-category.png') }}"
                                                    class="img-thumbnail opacity-75"
                                                    style="width: 80px; height: 80px; object-fit: cover;" alt="No Image">
                                            @endif
                                        </td>

                                        <!-- Name -->
                                        <td class="fw-semibold">
                                            {{ $product->name }}
                                        </td>

                                        <!-- Stock -->
                                        <td>
                                            <span
                                                class="badge
                                        {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>

                                        <!-- Price -->
                                        <td class="fw-semibold text-dark">
                                            {{ number_format($product->price, 2) }} EGP
                                        </td>

                                        <!-- Category -->
                                        <td>
                                            {{ $product->category->name ?? '—' }}
                                        </td>

                                        <!-- Discount -->
                                        <td>
                                            @if ($product->discount > 0)
                                                <span class="badge bg-warning text-dark">
                                                    {{ $product->discount }}%
                                                </span>
                                            @else
                                                <span class="text-muted">0</span>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span
                                                class="badge
                                        {{ $product->status ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.products.edit', $product->slug) }}"
                                                    class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmSingleDelete('{{ route('admin.products.destroy', $product->slug) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="10" class="text-muted py-5">
                                            No products found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </form>

            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- Hidden Delete Form -->
        <form id="single-delete-form" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection

@vite(['resources/js/backend/admin.js'])
