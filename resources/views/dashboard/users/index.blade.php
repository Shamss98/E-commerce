@extends('backend._app')

@section('title', 'Users')

@section('content')

    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">All Users</h3>
        </div>

        <!-- Card -->
        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle text-center mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($users as $user)
                                <tr>

                                    <td class="fw-semibold">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <span
                                            class="badge rounded-pill
                                        {{ $user->role == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $user->updated_at->format('Y-m-d') }}</td>

                                    <!-- Actions -->
                                    <td class="d-flex justify-content-center gap-2">

                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-primary px-3">
                                            Edit
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger px-3">
                                                Delete
                                            </button>
                                        </form>

                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted py-4">
                                        No users found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

@endsection
