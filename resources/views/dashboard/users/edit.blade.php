@extends('backend._app')

@section('title', 'Edit User')

@section('content')

    <div class="container py-4">

        <!-- Title -->
        <div class="mb-4">
            <h3 class="fw-bold text-primary">Edit User</h3>
        </div>

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" name="password" disabled
                            placeholder="Leave blank to keep current password">
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                User
                            </option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            Back
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
