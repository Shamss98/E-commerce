@extends('backend._app')

@section('title', 'Edit Product')

@section('content')

    <div class="container py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1">Edit Product</h2>
                <small class="text-muted">Update product information</small>
            </div>

            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.products.update', $product->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug"
                                class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $product->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">EGP</span>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}" step="0.01">
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Discount --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Discount (%)</label>
                            <input type="number" name="discount"
                                class="form-control @error('discount') is-invalid @enderror"
                                value="{{ old('discount', $product->discount) }}">
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Product Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Preview --}}
                            @if ($product->image)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                    class="img-thumbnail rounded-3 shadow-sm" width="120">
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
