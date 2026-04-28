@extends('backend._app')
@section('title', 'Create Coupon')

@section('content')
<div class="container">
    <h1>Create Coupon</h1>
    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Discount Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Discount Type</label>
            <select name="type" id="type">
                <option value="percentage">Percentage</option>
                <option value="fixed">Fixed Amount</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" class="form-control" id="discount" name="value" required>
        </div>
        <div class="mb-3">
            <label for="min_cart" class="form-label">Minimum Cart Value</label>
            <input type="number" class="form-control" id="min_cart" name="min_cart">
        </div>
        <div class="mb-3">
            <label for="max_discount" class="form-label">Maximum Discount</label>
            <input type="number" class="form-control" id="max_discount" name="max_discount">
        </div>
        <div class="mb-3">
            <label for="expires_at" class="form-label">Expiration Date</label>
            <input type="datetime-local" class="form-control" id="expires_at" name="expires_at" required>
        </div>
        <div class="mb-3">
            <label for="usage_limit" class="form-label">Maximum Uses</label>
            <input type="number" class="form-control" id="usage_limit" name="usage_limit" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Coupon</button>
    </form>
</div>
@endsection
