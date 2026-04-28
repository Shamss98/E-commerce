@extends('frontend.layout.app')

@section('title', 'Categories')

@section('content')

<div class="container py-5">

    <x-breadcrumb :links="[
        ['name' => 'Categories', 'url' => route('categories.index')],
    ]" />
    {{-- Title --}}
    <h1 class="text-center mb-5 text-primary fw-bold text-uppercase">
        Categories
    </h1>

    <div class="row ">

        @foreach ($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 wow animate__animated animate__zoomIn">

                <div class="card h-100 border-0 shadow-sm category-card p-2">

                    {{-- Image --}}
                    <div class="overflow-hidden rounded-top text-center p-3">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="img-fluid "
                                style="height:150px; width: 150px; object-fit:cover;"
                                alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset('images/default-category.png') }}"
                                class="img-fluid w-100"
                                style="height:200px; object-fit:cover;"
                                alt="{{ $category->name }}">
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="card-body text-center d-flex flex-column">

                        <h5 class="card-title fw-semibold text-dark">
                            {{ $category->name }}
                        </h5>

                        <p class="card-text text-muted small">
                            {{ Str::limit($category->description, 90) }}
                        </p>

                        {{-- Button --}}
                        <div class="mt-auto">
                            <a href="{{ route('categories.show', $category->slug) }}"
                                class="btn btn-outline-primary w-100">
                                View Details
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>

{{-- Custom CSS --}}
<style>
    .category-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .category-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .category-card img {
        transition: transform 0.3s ease;
    }

    .category-card:hover img {
        transform: scale(1.05);
    }
</style>

@endsection
