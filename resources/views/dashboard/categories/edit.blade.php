@extends( 'backend._app' )

@section('title', 'Edit Category')

@section('content')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Category</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug"
                                    class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4" required>{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>

    <select name="status" id="status"
        class="form-select @error('status') is-invalid @enderror" required>

        <option value="1"
            {{ old('status', $category->status) == '1' ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $category->status) == '0' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
