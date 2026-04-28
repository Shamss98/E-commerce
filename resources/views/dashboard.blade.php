@extends('backend._app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4 text-primary">📊 Dashboard</h2>

    <div class="row g-3">

        {{-- Products --}}
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa-brands fa-shopify"></i> Products</h5>
                    <h2>{{ $productsCount }}</h2>
                </div>
            </div>
        </div>

        {{-- Installment Plans --}}
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa-solid fa-list"></i> Categories</h5>

                    <h2>{{ $categoriesCount }}</h2>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-dark shadow-sm">
                <div class="card-body">
                    <h5  class="card-title text-white"> <i class="fa-solid fa-users"></i> Users</h5>
                    <h2>{{ $usersCount }}</h2>
                </div>
            </div>
        </div>

                <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa-solid fa-list"></i> Total Price</h5>
                    <h2>{{ $totalPrice }}</h2>
                </div>
            </div>
        </div>

        {{-- total stock --}}

                        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa-solid fa-list"></i> Total Stock</h5>
                    <h2>{{ $totalStock }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
