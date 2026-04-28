@extends('frontend.layout.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h4 class="fw-bold text-primary mb-0">
                            <i class="bi bi-truck me-2"></i> Shipping Information
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('checkout.placeOrder') }}" method="POST">
                            @csrf

                            {{-- Address Field --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Delivery Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-geo-alt"></i></span>
                                    <input type="text" name="address" class="form-control border-start-0 ps-0"
                                        placeholder="e.g. 123 Street Name">
                                    @error('address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- City Field --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">City</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-building"></i></span>
                                    <input type="text" name="city" class="form-control border-start-0 ps-0"
                                        placeholder="e.g. Cairo">
                                    @error('address')
                                        <div class="invalid-feedback is-invalid">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone Number Field --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="tel" name="phone_number" class="form-control border-start-0 ps-0"
                                        placeholder="e.g. 010XXXXXXXX">
                                </div>
                                <div class="form-text small text-muted">We'll only use this for delivery updates.</div>
                                @error('address')
                                    <div class="invalid-feedback is-invalid">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm py-2 fw-bold">
                                    Confirm & Place Order <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
