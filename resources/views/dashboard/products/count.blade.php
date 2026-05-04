@extends('backend._app')

@section('title', 'Products')

@section('content')

    <div class="container-fluid py-3">
        <div>
            <h1> Products Count</h1>

        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">

                <thead class="table-light">
                    <tr class="text-uppercase small text-muted">
                      
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)
                        <tr>

                            <!-- Checkbox -->


                            <td class="fw-bold text-secondary">
                                #{{ $product->id }}
                            </td>
                              {{-- {{ dd($product->image) }} --}}
                            <!-- Image -->
<td>
    @if($product->image)
        <img src="{{ Storage::url($product->image) }}"
             class="img-thumbnail shadow-sm"
             style="width:50px;height:50px;object-fit:cover;">
    @else
        <span class="text-muted">No Image</span>
    @endif
</td>

                            <!-- Name -->
                            <td class="fw-semibold">
                                {{ $product->name }}
                            </td>

                            <!-- Stock -->
                            <td>
                                <span
                                    class="badge
                                        {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="fw-semibold text-dark">
                                {{ number_format($product->price, 2) }} EGP
                            </td>

                            <!-- Category -->
                            <td>
                                {{ $product->category->name ?? '—' }}
                            </td>

                            <!-- Discount -->
                            <td>
                                @if ($product->discount > 0)
                                    <span class="badge bg-warning text-dark">
                                        {{ $product->discount }}%
                                    </span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                <span
                                    class="badge
                                        {{ $product->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>


                            <!-- Actions -->
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirmSingleDelete('{{ route('admin.products.destroy', $product->id) }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-muted py-5">
                                No products found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    <div class="card-footer bg-white border-0">
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
