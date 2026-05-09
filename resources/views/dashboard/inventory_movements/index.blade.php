@extends('backend._app')

@section('title', 'Inventory Movements')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Inventory Movements</h3>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Slug</th>
                        <th>Person</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($movements as $movement)
                        <tr>
                            <td>
                                {{ $movement->product->name }}
                            </td>

                            <td>
                                @if($movement->type == 'in')
                                    <span class="badge bg-success">IN</span>
                                @else
                                    <span class="badge bg-danger">OUT</span>
                                @endif
                            </td>

                            <td>
                                <span class="fw-bold">
                                    {{ $movement->quantity }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold">
                                    {{ $movement->product->slug }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $movement->user->name }}
                                </span>

                            </td>

                            <td>
                                <span class="fw-bold">
                                    {{ $movement->created_at->format('d/m/Y h:i A') }}
                                </span>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $movements->links() }}
    </div>

</div>

@endsection
