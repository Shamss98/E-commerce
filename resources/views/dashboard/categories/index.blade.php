@extends('backend._app')

@section('title', 'Categories')

@section('content')
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Categories</h3>

            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Category
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow rounded-4">
            <div class="card-body">

                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Bulk Actions -->
                <form action="{{ route('admin.categories.bulkDelete') }}" method="POST">
                    @csrf

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex gap-2">
                            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm px-3">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>

                        <span id="selected-count" class="text-muted small">
                            0 selected
                        </span>

                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle text-center">

                            <thead class="table-light">
                                <tr class="text-uppercase small text-muted">
                                    <th>
                                        <input type="checkbox" id="select-all"> All </th>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categories as $category)
                                    <tr>

                                        <!-- Checkbox -->
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{ $category->id }}"
                                                class="item-checkbox">
                                        </td>

                                        <!-- ID -->
                                        <td class="fw-bold text-secondary">
                                            #{{ $category->id }}
                                        </td>

                                        <!-- Image -->
                                        <td>
                                            <img src="{{asset('storage/'.$category->image) ??  $category->image }}" class="rounded-circle border shadow-sm"
                                                style="width:50px;height:50px;object-fit:cover;">
                                        </td>

                                        <!-- Name -->
                                        <td class="fw-semibold">
                                            {{ $category->name }}
                                        </td>

                                        <!-- Slug -->
                                        <td class="text-muted small">
                                            {{ $category->slug }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span
                                                class="badge rounded-pill
                                        {{ $category->status ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $category->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.categories.edit', $category->slug) }}"
                                                    class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmSingleDelete('{{ route('admin.categories.destroy', $category->slug) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-muted py-5">
                                            No categories found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </form>

            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-center">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- Hidden Delete Form -->
        <form id="single-delete-form" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection

@vite(['resources/js/backend/admin.js'])

{{-- @section('scripts')
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.item-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });

        function confirmSingleDelete(deleteUrl) {
            if (confirm('Are you sure you want to delete this category?')) {
                let form = document.getElementById('single-delete-form');

                form.action = deleteUrl;

                form.submit();
            }
        }
    </script>
@endsection --}}
