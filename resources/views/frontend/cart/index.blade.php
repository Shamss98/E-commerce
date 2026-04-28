@extends('frontend.layout.app')

@section('content')
    <div class="container py-5">
        <div class="divider d-flex align-items-center my-4" data-aos="fade-up" data-duration="3000">
            <h3 class="text-center text-primary fw-bold mx-3 mb-0">Your Shopping Cart</h3>
        </div>

        <style>
            .divider:after,
            .divider:before {
                content: "";
                flex: 1;
                height: 1px;
                background: #ced4da;
            }
        </style>

        <div class="row">
            <div class="col-lg-8">

                <div class="card mb-4" data-aos="fade-right" data-duration="2500">
                    <div class="card-body">

                        @forelse($cart->items as $item)
                            <div class="row cart-item mb-3 align-items-center">


                                <div class="col-md-3">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded"
                                        width="100">
                                </div>


                                <div class="col-md-5">
                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                    <p class="text-muted">
                                        Category: {{ $item->product->category->name ?? 'N/A' }}
                                    </p>
                                </div>


                                <div class="col-md-2">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="form-control form-control-sm text-center">
                                            <button class="btn btn-outline-primary btn-sm">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-2 text-end">
                                    <p class="fw-bold">
                                        ${{ $item->price * $item->quantity }}
                                    </p>

                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <hr>
                        @empty
                            <p>Your cart is empty</p>
                        @endforelse

                    </div>
                </div>

                <!-- Continue Shopping -->
                <div class="text-start mb-4" data-aos="fade-up" data-duration="2500">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>

            </div>

            <!-- Summary -->
            <div class="col-lg-4">
                <div class="card cart-summary" data-aos="fade-left" data-duration="2500">
                    <div class="card-body">

                        <h5 class="card-title mb-4">Order Summary</h5>



                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <strong class="text-muted">Discount</strong>
                            <strong class="text-opacity-75 text-danger">
                                -${{ number_format($discount, 2) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <strong>Final Total</strong>
                            <strong>${{ number_format($finalTotal, 2) }}</strong>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">
                            Proceed to Checkout
                        </a>

                    </div>
                </div>

                <!-- Promo Code -->
                <div class="card mt-4" data-aos="fade-left" data-duration="2500">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Apply Promo Code</h5>

                        <form method="POST" action="{{ route('cart.applyCoupon') }}">
                            @csrf
                            <input type="text" name="code">
                            <button>Apply</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
