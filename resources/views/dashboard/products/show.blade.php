@extends('backend._app')

@section('title', 'Product Details')

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- The main picture  --}}
            <div class="col-md-6 mb-4">
                @if ($product->image)
                    <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded w-100"
                        style="height: 400px; object-fit: contain;" alt="{{ $product->name }}">
                @else
                    <img id="mainImage" src="{{ asset('images/default-category.png') }}" class="img-fluid rounded w-100"
                        style="height: 400px; object-fit: contain;" alt="{{ $product->name }}">
                @endif
                {{-- product images --}}
                @if ($product->images && $product->images->count())
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        @foreach ($product->images as $img)
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="img-thumbnail"
                                style="width: 80px; height: 80px; object-fit: contain; cursor: pointer;"
                                onclick="changeMainImage(this)">
                        @endforeach
                    </div>
                @endif

            </div>

            {{-- Product details  --}}
            <div class="col-md-6">
                <h1 class="fw-bold">{{ $product->name }}</h1>
                <p class="text-white">Category: {{ $product->category->name }}</p>
                <p class="text-white">Stock: {{ $product->stock }}</p>
                <p class="text-muted">Status:
                    <span class="badge {{ $product->status ? 'bg-primary' : 'bg-secondary' }}">
                        {{ $product->status ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p class="text-muted">Created At: {{ $product->created_at->diffForHumans() }}</p>
                <p class="text-muted">Updated At: {{ $product->updated_at->diffForHumans() }}</p>
                <p class="text-muted">Description: {{ $product->description }}</p>

                @if ($product->discount > 0)
                    <span class="fw-bold text-danger fs-5">
                        ${{ $product->discounted_price }}
                        <del class="text-muted fs-6">${{ $product->price }}</del>
                    </span>
                @else
                    <span class="fw-bold text-primary fs-5">
                        ${{ $product->price }}
                    </span>
                @endif
                <a href="{{ route('admin.products.edit', $product->slug) }}" class="btn btn-primary">
                    Edit Product
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeMainImage(el) {
            document.getElementById('mainImage').src = el.src;
        }
    </script>
@endsection
