@extends('frontend.layout.app')

@section('title', 'New Products')
<style>
    /* Card Hover Effect */
    .product-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Image Zoom */
    .img-container img {
        transition: transform 0.3s ease;
    }

    .product-card:hover .img-container img {
        transform: scale(1.08);
    }

    /* Title */
    .product-title {
        font-size: 15px;
        min-height: 40px;
    }

    /* Description */
    .product-desc {
        height: 40px;
        overflow: hidden;
    }

    /* Status Badge */
    .status-badge {
        top: 10px;
        right: 10px;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
    }

    /* Button */
    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0d6efd;
        transform: scale(1.05);
    }
</style>
@section('content')
    <div class="container-fluid">

        <div class="row">

            {{-- Title --}}
            <h1 class="text-center mb-5 text-primary fw-bold text-uppercase mt-3"data-aos="fade-down" data-duration="2500">
                New Products
            </h1>

            @include('frontend.partials.filters', ['count' => $count])

            {{-- ================== PRODUCTS ================== --}}
            <div class="col-lg-10">

                <div class="row ">

                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                            <div class="card h-100 border-0 shadow-sm product-card p-3">

                                {{-- Status Badge --}}
                                <span
                                    class="badge status-badge position-absolute {{ $product->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                                </span>

                                {{-- Image Container --}}
                                <div class="img-container p-3 mb-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-category.png') }}"
                                        class="img-fluid" style="height: 180px; object-fit: contain;"
                                        alt="{{ $product->name }}">
                                </div>

                                {{-- Body --}}
                                <div class="card-body p-0 d-flex flex-column">
                                    <h6 class="product-title fw-bold text-dark mb-1">
                                        {{ $product->name }}
                                    </h6>

                                    <p class="product-desc text-muted small mb-3">
                                        {{ $product->description }}
                                    </p>

                                    {{-- Price Section --}}
                                    <div class="mb-3">
                                        @if ($product->discount > 0)
                                            <span class="fs-5 fw-bold text-danger">
                                                ${{ $product->discounted_price }}
                                            </span>
                                            <span class="badge bg-danger ms-2">Sale</span>
                                            <br>
                                            <del class="text-muted small">${{ $product->price }}</del>
                                        @else
                                            <span class="fs-5 fw-bold text-dark">
                                                ${{ $product->price }}
                                            </span>
                                        @endif
                                    </div>
                                    {{-- Button --}}
                                    <div class="mt-auto">
                                        <a href="{{ route('products.show', $product->slug) }}"
                                            class="btn btn-primary w-100 rounded-pill fw-semibold">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>

        </div>
    </div>
@endsection
