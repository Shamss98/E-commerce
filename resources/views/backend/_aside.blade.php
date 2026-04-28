<div class="sidebar">

    @php
        $user = auth()->user();
    @endphp
    <h4 class="text-center mb-4 text-white">{{ $user->name }}</h4>

    <a href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#productsMenu"
        role="button" aria-expanded="false">

        <span>
            <i class="bi bi-tags"></i> products
        </span>

        <i class="bi bi-chevron-down"></i>
    </a>

    <div class="collapse ps-3" id="productsMenu">

        <a href="{{ route('admin.products.index') }}" class="d-block py-1">
            All Products
        </a>

        <a href="{{ route('admin.products.create') }}" class="d-block py-1">
            Create Product
        </a>

    </div>


    {{-- Categories Dropdown --}}
    <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#categoriesMenu"
        role="button" aria-expanded="false">

        <span>
            <i class="bi bi-tags"></i> Categories
        </span>

        <i class="bi bi-chevron-down"></i>
    </a>

    <div class="collapse ps-3" id="categoriesMenu">

        <a href="{{ route('admin.categories.index') }}" class="d-block py-1">
            All Categories
        </a>

        <a href="{{ route('admin.categories.create') }}" class="d-block py-1">
            Create Category
        </a>

    </div>

    {{-- coupon Dropdown --}}
    <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#couponsMenu"
        role="button" aria-expanded="false">

        <span>
            <i class="bi bi-tags"></i> Coupons
        </span>

        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse ps-3" id="couponsMenu">

        <a href="{{ route('admin.coupons.index') }}" class="d-block py-1">
            All Coupons
        </a>

        <a href="{{ route('admin.coupons.create') }}" class="d-block py-1">
            Create Coupon
        </a>
        {{-- <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="d-block py-1">
            Edit Coupon
        </a>
         --}}
    </div>

    {{-- installment plan Dropdown --}}
    <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#installmentPlansMenu"
        role="button" aria-expanded="false">

        <span>
            <i class="bi bi-tags"></i> Installment
        </span>

        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse ps-3" id="installmentPlansMenu">

        <a href="{{ route('admin.installment-plans.index') }}" class="d-block py-1">
            Installment
        </a>

        <a href="{{ route('admin.installment-plans.create') }}" class="d-block py-1">
            Create Installment
        </a>
    </div>

    {{-- Users Dropdown --}}
    <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#usersMenu"
        role="button" aria-expanded="false">

        <span>
            <i class="bi bi-tags"></i> Users
        </span>

        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse ps-3" id="usersMenu">

        <a href="{{ route('admin.users.index') }}" class="d-block py-1">
            All Users
        </a>

        <a href="{{ route('admin.users.create') }}" class="d-block py-1">
            Create User
        </a>
    </div>

</div>
