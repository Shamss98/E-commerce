@extends('backend._app')

@section('title', 'Installment Plans')

@section('content')
    <div class="container py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary mb-0">Installment Plans</h2>

            <a href="{{ route('admin.installment-plans.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Plan
            </a>
        </div>

        {{-- Card --}}
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- BULK FORM --}}
                <form action="{{ route('admin.installment-plans.bulkDelete') }}" method="POST">
                    @csrf

                    {{-- Bulk Actions --}}
                    <div class="d-flex gap-2 mb-3">
                        <button type="submit" name="action" value="delete" class="btn btn-danger">
                            Delete Selected
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            {{-- HEAD --}}
                            <thead class="table-light text-center">
                                <tr class="text-uppercase small text-muted">

                                    <th>
                                        <input type="checkbox" id="select-all">
                                    </th>

                                    <th>#</th>
                                    <th>Months</th>
                                    <th>Interest</th>
                                    <th>Status</th>
                                    <th width="200">Actions</th>

                                </tr>
                            </thead>

                            {{-- BODY --}}
                            <tbody class="text-center">

                                @forelse($plans as $plan)
                                    <tr>

                                        {{-- checkbox --}}
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{ $plan->id }}"
                                                class="item-checkbox">
                                        </td>

                                        <td class="fw-bold text-secondary">
                                            #{{ $plan->id }}
                                        </td>

                                        <td>
                                            <span class="badge bg-info-subtle text-info px-3 py-2">
                                                {{ $plan->months }} Months
                                            </span>
                                        </td>

                                        <td class="fw-semibold text-success">
                                            {{ $plan->interest_rate }}%
                                        </td>

                                        <td>
                                            <span
                                                class="badge px-3 py-2
                                            {{ $plan->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        {{-- ACTIONS --}}
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.installment-plans.edit', $plan->id) }}"
                                                    class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>


                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmSingleDelete('{{ route('admin.installment-plans.softDelete', $plan->id) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted py-5">
                                            No installment plans found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
            </div>
            </form>


            <form id="single-delete-form" method="POST" style="display:none;">
                @csrf
            </form>

            {{-- Pagination --}}
            <div class="p-3">
                {{ $plans->links() }}
            </div>

        </div>
    </div>
@endsection

@vite(['resources/js/backend/admin.js'])
