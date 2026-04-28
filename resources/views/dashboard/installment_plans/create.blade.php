@extends('backend._app')

@section('title', 'Create Installment Plan')

@section('content')
    <div class="container py-4">

        {{-- Header --}}
        <div class="mb-4">
            <h2 class="fw-bold text-primary">➕ Create Installment Plan</h2>
            <p class="text-muted">Add a new payment installment plan</p>
        </div>

        {{-- Card --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.installment-plans.store') }}" method="POST">
                    @csrf

                    {{-- Months --}}
                    <div class="mb-3">
                        <label for="months" class="form-label fw-semibold">
                            📅 Months
                        </label>
                        <input type="number" class="form-control form-control-lg" id="months" name="months"
                            placeholder="Months" required>
                    </div>

                    {{-- Interest Rate --}}
                    <div class="mb-3">
                        <label for="interest_rate" class="form-label fw-semibold">
                            💰 Interest Rate (%)
                        </label>
                        <input type="number" step="0.01" class="form-control form-control-lg" id="interest_rate"
                            name="interest_rate" placeholder="%" required>
                    </div>

                    {{-- Active --}}
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            checked>
                        <label class="form-check-label fw-semibold" for="is_active">
                            Active Plan
                        </label>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.installment-plans.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            Create Plan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
