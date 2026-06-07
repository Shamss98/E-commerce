<nav class="navbar navbar-expand-lg bg-info-light shadow-sm">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand fw-bold text-primary text-uppercase " href="{{ url('/') }}">
            Shams-Store
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($all_categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">All Categories</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-arrow-down"></i> cart</a>
                </li>

            </ul>

            <!-- Search -->
            <form action="{{ route('products.search') }}" method="GET" class="d-flex me-3 mb-2" role="search">
                <input class="form-control me-2" type="text" name="q" placeholder="Search Product" aria-label="Search" autocomplete="off" autofocus type="search">
                <button class="btn btn-outline-primary" type="submit">
                    Search
                </button>
            </form>

            <!-- Auth Links -->
            <div class="d-flex align-items-center gap-2">

                @guest
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">
                        Login
                    </a>

                    <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                        Register
                    </a>
                @endguest

                @auth
                    <span class="me-2 fw-semibold">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Logout
                        </button>
                    </form>
                @endauth

            </div>

        </div>
    </div>
</nav>
