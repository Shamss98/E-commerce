@extends('frontend.layout.app')

@section('title', $category->name)

@section('content')

<div class="container-fluid py-5">

    {{-- Category Title --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">{{ $category->name }}</h1>
        <p class="text-muted w-75 mx-auto">
            {{ $category->description }}
        </p>
    </div>

    {{-- Products --}}
    <div class="row g-4">

        @foreach ($category->products as $product)
            <div class="col-lg-2 col-md-4 col-sm-6">

                <div class="card h-100 border-0 shadow-sm product-card">
                    <a href="{{ route('products.show', $product->slug) }}">
                    {{-- Image --}}
                    <div class="text-center p-3">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="img-fluid rounded"
                                style="height:170px; width:100%; object-fit:contain;"
                                alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/default-category.png') }}"
                                class="img-fluid rounded"
                                style="height:170px; width:170px; object-fit:cover;"
                                alt="{{ $product->name }}">
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="card-body text-center d-flex flex-column">

                        <h6 class="fw-semibold text-dark">
                            {{ $product->name }}
                        </h6>

                        <p class="text-muted small">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        {{-- Button --}}
                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="btn btn-outline-primary w-100">
                                View Details
                            </a>
                        </div>

                    </div>
</a>
                </div>

            </div>
        @endforeach

    </div>

</div>

{{-- Custom CSS --}}
<style>
    .product-card {
        transition: all 0.3s ease;
        background: #fff;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
    }
</style>

@endsection
