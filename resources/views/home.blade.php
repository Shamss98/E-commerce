@extends('frontend.layout.app')

@section('content')
{{-- carousel section --}}
    <div id="carouselExample" class="carousel slide h-50" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/herosection.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/herosection.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/herosection.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- categories --}}
    <div class="container">
        <div class="row py-5 bg-white align-items-center">
            <h2 class="text-center mb-4 text-primary text-uppercase">Categories</h2>


            @foreach ($categories as $category)
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="col-md-3 mb-4 text-center">

                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="category-item text-decoration-none">

                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" class="category-img"
                                    alt="{{ $category->name }}">
                            @else
                                <img src="{{ asset('images/default-category.png') }}" class="category-img"
                                    alt="{{ $category->name }}">
                            @endif

                            <h6 class="mt-3 text-primary text-center">{{ $category->name }}</h6>
                            {{-- <p>{{ Str::limit($category->description, 100) }}</p> --}}

                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <hr class=" container my-5text-bold">

    {{-- products --}}
    <div class="container-fluid py-5">

        <h2 class="text-center mb-5 text-primary text-uppercase fw-bold">
            Products
        </h2>

        <div class="row g-3" id="products-wrapper">

            @foreach ($products as $product)
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">

                    <div class="text-center product-card p-3 h-100 border rounded-3 shadow-sm position-relative">

                        <a href="{{ route('products.show', $product->slug) }}"
                            class="text-decoration-none text-dark d-block">

                            {{-- Image --}}
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/default-product.png') }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @endif

                            {{-- Name --}}
                            <h6 class="fw-semibold">
                                {{ $product->name }}
                            </h6>

                            {{-- Description --}}
                            <p class="text-muted small">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            @if ($product->discount > 0)
                                <span class="fw-bold text-danger">
                                    ${{ $product->discounted_price }} <del class="text-muted">${{ $product->price }}</del>
                                </span>
                            @else
                                <span class="fw-bold text-primary">
                                    ${{ $product->price }}
                                </span>
                            @endif
                            @if ($product->stock > 0)
                                <p class="small text-success">In Stock</p>
                            @else
                                <p class="small text-danger">Out of Stock</p>
                            @endif
                            @if ($product->status == 1)
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                    Inactive
                                </span>
                            @endif

                        </a>

                    </div>

                </div>
            @endforeach
  <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        </div>

    </div>



    {{-- Offers Section --}}
    <div class="container-fluid py-5 bg-dark text-light !important">

        <h2 class="text-center mb-5 text-warning text-uppercase fw-bold">
            Special Offers
        </h2>

        <div class="row align-items-center">

            <!-- Text -->
            <div class="col-lg-6 col-12 text-center text-lg-start px-5 mb-4 mb-lg-0" data-aos="zoom-in-up">

                <h1 class="fw-bold mb-3">
                    🔥 Mega Sale
                </h1>

                <p class="mb-4 fs-5">
                    Get up to 50% off on selected products
                </p>

                <a href="#" class="btn btn-warning fw-bold px-4 py-2">
                    Shop Now
                </a>

            </div>

            <!-- Image -->
            <div class="col-lg-6 col-12 text-center" data-aos="zoom-in-up" >

                <img src="{{ asset('images/offer-banner.jpg') }}" alt="offer" class="img-fluid rounded-4 shadow-lg"
                    style="max-height: 400px; object-fit: cover;">

            </div>

        </div>
    </div>

    <div class="container-fluid py-5">

        {{-- <h2 class="text-center mb-5 text-primary text-uppercase fw-bold">
        New Arrivals
    </h2> --}}

        <div class="row g-3">

            @foreach ($productsDiscounted as $product)
                <div class="col-lg-2 col-md-4 col-sm-6">

                    <div class="text-center product-card p-3 h-100 border rounded-3 shadow-sm position-relative"
                        data-aos="zoom-in">

                        <a href="{{ route('products.show', $product->slug) }}"
                            class="text-decoration-none text-dark d-block">

                            {{-- Image --}}
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/default-product.png') }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @endif

                            {{-- Name --}}
                            <h6 class="fw-semibold">
                                {{ $product->name }}
                            </h6>

                            {{-- Description --}}
                            <p>{{ Str::limit($product->description, 80) }}</p>

                            @if ($product->discount > 0)
                                <span class="fw-bold text-danger">
                                    ${{ $product->discounted_price }} <del
                                        class="text-muted">${{ $product->price }}</del>
                                </span>
                            @else
                                <span class="fw-bold text-primary">
                                    ${{ $product->price }}
                                </span>
                            @endif
                            @if ($product->stock > 0)
                                <p class="small text-success">In Stock</p>
                            @else
                                <p class="small text-danger">Out of Stock</p>
                            @endif
                            @if ($product->status == 1)
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                    Inactive
                                </span>
                            @endif

                        </a>

                    </div>

                </div>
            @endforeach

        </div>

    </div>



    <div class="container-fluid py-5 bg-light text-dark !important">

        <h2 class="text-center mb-5 text-primary text-uppercase fw-bold">
            Why Choose Us?
        </h2>

        <div class="row g-4">

            <div class="col-md-4 text-center" data-aos="zoom-in">
                <i class="fas fa-shipping-fast fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">Fast Shipping</h5>
                <p>Get your orders delivered in record time with our efficient shipping network.</p>
            </div>

            <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-delay="200">
                <i class="fas fa-headset fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">24/7 Support</h5>
                <p>Our customer support team is here to assist you around the clock.</p>
            </div>

            <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-delay="400">
                <i class="fas fa-thumbs-up fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">Quality Products</h5>
                <p>We offer only the best products, carefully selected for quality and value.</p>
            </div>

        </div>

    </div>

    <div class="container-fluid py-5">

        <h2 class="text-center mb-5 text-primary text-uppercase fw-bold">
            New Arrivals
        </h2>

        <div class="row g-3">

            @foreach ($products_latest as $product)
                <div class="col-lg-2 col-md-4 col-sm-6">

                    <div class="text-center product-card p-3 h-100 border rounded-3 shadow-sm position-relative"
                        data-aos="zoom-in">

                        <a href="{{ route('products.show', $product->slug) }}"
                            class="text-decoration-none text-dark d-block">

                            {{-- Image --}}
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/default-product.png') }}" class="img-fluid rounded mb-3"
                                    style="height:150px; width:100%; object-fit:contain;" alt="{{ $product->name }}">
                            @endif

                            {{-- Name --}}
                            <h6 class="fw-semibold">
                                {{ $product->name }}
                            </h6>

                            {{-- Description --}}
                            <p>{{ Str::limit($product->description, 80) }}</p>

                            @if ($product->discount > 0)
                                <span class="fw-bold text-danger">
                                    ${{ $product->discounted_price }} <del
                                        class="text-muted">${{ $product->price }}</del>
                                </span>
                            @else
                                <span class="fw-bold text-primary">
                                    ${{ $product->price }}
                                </span>
                            @endif
                            @if ($product->stock > 0)
                                <p class="small text-success">In Stock</p>
                            @else
                                <p class="small text-danger">Out of Stock</p>
                            @endif
                            @if ($product->status == 1)
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                    Inactive
                                </span>
                            @endif

                        </a>

                    </div>

                </div>
            @endforeach

        </div>

    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination a')) {
        e.preventDefault();

        let url = e.target.closest('a').href;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(data => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(data, 'text/html');

            document.querySelector('#products-wrapper').innerHTML =
                doc.querySelector('#products-wrapper').innerHTML;


        });
    }
});
</script>

@endsection
