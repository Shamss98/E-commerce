@extends('frontend.layout.app')

@section('title', 'Search')

@section('content')

    <div class="container-fluid py-5 ">

        <x-breadcrumb :links="[['name' => 'Search', 'url' => route('products.search')]]" />

        {{-- Title --}}
        <h1 class="text-center mb-5 text-primary fw-bold text-uppercase">
            Search
        </h1>



        @if ($products->count())
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100 shadow-sm border-0">

                            {{-- Product Image --}}
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: contain;" alt="{{ $product->name }}">

                            <div class="card-body d-flex flex-column">

                                {{-- Name --}}
                                <h6 class="card-title fw-bold text-dark">
                                    {{ $product->name }}
                                </h6>

                                {{-- Category --}}
                                <small class="text-muted mb-2">
                                    {{ $product->category->name ?? 'No Category' }}
                                </small>
                                {{-- Discount --}}
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

                                {{-- Button --}}
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="btn btn-outline-primary mt-auto w-100">
                                    View Details
                                </a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="fs-5 text-muted">No results found</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>

            {{ $products->links() }}
        @else
            <p>No results found</p>
        @endif

    </div>

@endsection
