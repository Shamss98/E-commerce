@extends('frontend.layout.app')

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


            <div class="col-md-6">
                <h2 class="text-primary fw-bold">{{ $product->name }}</h2>

                <p class="text-muted">{{ $product->description }}</p>


                @if ($product->discount > 0)
                    <span class="fw-bold text-danger fs-5">
                        {{number_format($product->discounted_price, 2)}} L.E
                        <del class="text-muted fs-6">{{number_format($product->price, 2)}} L.E </del>
                    </span>
                @else
                    <span class="fw-bold text-primary fs-5">
                        ${{number_format($product->price, 2) }}
                    </span>
                @endif


                <div class="mt-3">
                    <p class="mb-1">Stock: {{ $product->stock }}</p>
                    <p class="mb-1">Category: {{ $product->category->name }}</p>

                    <p class="mb-1">
                        Status:
                        <span class="badge {{ $product->status ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn btn-success btn-lg">
                        Add to Cart
                    </button>
                </form>
            </div>

        </div>
    </div>
    <hr class="my-5 border-0" style="height:1px; background-color:#e9ecef;">
    @if ($relatedProducts->count())
        <div class="mt-5">
            <h3 class="mb-4 text-center text-primary fw-bold">Related Products</h3>

            <div class="row g-3">
                @foreach ($relatedProducts as $item)
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="card h-100 shadow-sm border rounded-3 product-card bg-white" data-aos="fade-up">


                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: contain;">

                            <div class="card-body text-center">


                                <h6 class="fw-bold text-truncate">
                                    {{ $item->name }}
                                </h6>


                                @if ($item->discount > 0)
                                    <span class="text-danger fw-bold">
                                        ${{ $item->discounted_price }}
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        <del>${{ $item->price }}</del>
                                    </small>
                                @else
                                    <span class="text-primary fw-bold">
                                        ${{ $item->price }}
                                    </span>
                                @endif


                                <div class="mt-2">
                                    <a href="{{ route('products.show', $item->slug) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        View
                                    </a>

                                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm w-100 mt-2">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
        {{-- installment options --}}
        <hr class="my-5 border-0" style="height:1px; background-color:#e9ecef;">
<div class="installment-plans mt-5">
    <h4 class="mb-4 fw-bold text-primary text-center">Installment Plans</h4>

    <div class="list-group shadow-sm rounded-3 overflow-hidden">

        @foreach($interestPlans as $plan)
            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">

                <div class="d-flex align-items-center gap-3">
                    <input
                        class="form-check-input mt-0"
                        type="radio"
                        name="selected_plan"
                        value="{{ $plan->months }}"
                    >
                    <div>
                        <h6 class="mb-1 fw-bold">
                            {{ $plan->months }} Months
                        </h6>
                        <small class="text-muted">
                            Interest: {{ $plan->interest_rate }}%
                        </small>
                    </div>
                </div>

                <div class="text-end">
                    <div class="fw-bold text-success">
                        {{ number_format($plan->monthly) }} EGP
                    </div>
                    <small class="text-muted">Per Month</small>
                </div>

                @if($plan->is_active == 0)
                    <span class="badge bg-danger rounded-pill px-3 py-2">
                        Inactive
                    </span>
                @else
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        Active
                    </span>
                @endif

                <span class="badge bg-primary rounded-pill px-3 py-2">
                    Total: {{ number_format($plan->total) }} EGP
                </span>

            </label>
        @endforeach

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
