@extends('backend._app')

@section('title', 'Edit Installment Plan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Installment Plan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.installment-plans.update', $installmentPlan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="months" id="name" class="form-control"
                        value="{{ old('months', $installmentPlan->months) }}" required>
                </div>

                <div class="form-group">
                    <label for="installment_count">Installment Count</label>
                    <input type="number" name="interest_rate" id="installment_count" class="form-control"
                        value="{{ old('interest_rate', $installmentPlan->interest_rate) }}" required>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                    <label class="form-check-label fw-semibold" for="is_active">
                        Active Plan
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Update Installment Plan</button>
            </form>
        </div>
    </div>
@endsection
