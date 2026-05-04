<div class="header d-flex justify-content-between align-items-center">

    <h5 class="mb-0 text-info">Dashboard</h5>

                        <!-- Search -->
            <form action="{{ route('admin.products.search') }}" method="GET" class="d-flex me-3" role="search">
                <input class="form-control me-2 bg-white" type="text" name="q" placeholder="Search Product" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">
                    Search
                </button>
            </form>

    <div class="d-flex align-items-center gap-3">
        <i class="bi bi-bell"></i>

        <span>{{ auth()->user()->name }}</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>


    </div>


</div>
