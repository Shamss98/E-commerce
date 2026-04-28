@extends('frontend.layout.app')

@section('title', 'Products')

@section('content')

<div class="container-fluid py-5 ">

<x-breadcrumb :links="[
    ['name' => 'Products', 'url' => route('products.index')],
]" />

{{-- Title --}}
<h1 class="text-center mb-5 text-primary fw-bold text-uppercase">
    Products
</h1>

<div class="row">

    <h3 class="text-danger">Search Products</h3>
    {{-- ================== FILTER SIDEBAR ================== --}}
    @include('frontend.partials.filters', ['count' => $count])
    {{-- ================== PRODUCTS ================== --}}
    <div class="col-lg-10">

        <div class="row ">

            @forelse ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-duration="2500">

                    <div class="card h-100 border-0 shadow-sm product-card p-2 position-relative">

                        {{-- Image --}}
                        <a class="" href="{{ route('products.show', $product->slug) }}">
                        <div class="overflow-hidden rounded-top text-center p-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="img-fluid"
                                    style="height:170px; width:100%; object-fit:contain;"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/default-category.png') }}"
                                    class="img-fluid"
                                    style="height:150px; width:120px; object-fit:contain;"
                                    alt="{{ $product->name }}">
                            @endif
                        </div>
                        </a>

                        {{-- Body --}}
                        <div class="card-body text-center d-flex flex-column">

                            <h6 class="fw-semibold text-dark">
                                {{ $product->name }}
                            </h6>

                            <p class="text-muted small">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            {{-- Price --}}
                            @if ($product->discount > 0)
                                <span class="fw-bold text-danger">
                                    ${{ $product->discounted_price }}
                                    <del class="text-muted">${{ $product->price }}</del>
                                </span>
                            @else
                                <span class="fw-bold text-primary">
                                    ${{ $product->price }}
                                </span>
                            @endif

                            {{-- Button --}}
                            <div class="mt-auto">
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="btn btn-outline-primary w-100">
                                    View Details
                                </a>
                            </div>

                        </div>

                        {{-- Status Badge --}}
                        @if ($product->status == 1)
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                Active
                            </span>
                        @else
                            <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                Inactive
                            </span>
                        @endif

                    </div>

                </div>
            @empty
                <div class="col-12 text-center">
                    <h5 class="text-muted">No products found</h5>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4" data-aos="fade-up">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>

</div>
@endsection
