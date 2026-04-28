<div class="col-lg-2 mb-4 p-0" data-aos="fade-right" data-duration="2500">
    <div class="card shadow-sm border-0 p-3">

        <h5 class="fw-bold mb-3">Filters</h5>

        <a href="{{ route('products.new') }}" class="filter-link d-block mb-2">
            New Products
            <span class="badge bg-danger ms-2">
                {{ $count ?? 0 }}
            </span>
        </a>

        <a href="#" class="filter-link d-block">
            Best Selling
        </a>

    </div>
</div>
