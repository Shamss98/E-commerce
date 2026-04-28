@extends('backend._app')

@section('title', 'Coupons')

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Coupons</h3>

        <a href="{{ route('admin.coupons.create') }}"
           class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg"></i> Create Coupon
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow border-0 rounded-4">
        <div class="card-body">

            <!-- Errors -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Bulk Form -->
            <form action="{{ route('admin.coupons.bulkDelete') }}" method="POST">
                @csrf

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <button type="submit" name="action" value="delete"
                            class="btn btn-danger btn-sm px-3">
                        <i class="bi bi-trash"></i> Delete Selected
                    </button>

                    <span id="selected-count" class="text-muted small">
                        0 selected
                    </span>

                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">

                        <thead class="table-dark">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th>#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Expiry</th>
                                <th>Used</th>
                                <th>Limit</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($coupons as $coupon)
                            <tr>

                                <td>
                                    <input type="checkbox"
                                           name="ids[]"
                                           value="{{ $coupon->id }}"
                                           class="item-checkbox">
                                </td>

                                <td class="fw-semibold">#{{ $coupon->id }}</td>

                                <td>
                                    <span class="badge bg-dark">
                                        {{ $coupon->code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge
                                        {{ $coupon->type == 'percentage' ? 'bg-success' : 'bg-info' }}">
                                        {{ ucfirst($coupon->type) }}
                                    </span>
                                </td>

                                <td class="fw-semibold">
                                    {{ $coupon->value }}
                                    {{ $coupon->type == 'percentage' ? '%' : 'EGP' }}
                                </td>

                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d') }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $coupon->usage_count }}
                                    </span>
                                </td>

                                <td>
                                    {{ $coupon->usage_limit }}
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="confirmSingleDelete('{{ route('admin.coupons.destroy', $coupon->id) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-muted py-5">
                                    No coupons found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- Hidden Delete -->
<form id="single-delete-form" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@endsection

@vite(['resources/js/backend/admin.js'])
