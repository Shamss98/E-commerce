<div class="header d-flex justify-content-between align-items-center">

    <h5 class="mb-0 text-info">Dashboard</h5>

                        <!-- Search -->
            <form action="{{ route('admin.products.search') }}" method="GET" class="d-flex me-3" role="search">
                <input class="form-control me-2 bg-white" type="text" name="q" placeholder="Search Product" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">
                    Search
                </button>
            </form>

<div class="d-flex align-items-center gap-4">

    <!-- Notifications -->
    <div class="dropdown position-relative">
        <div data-bs-toggle="dropdown" style="cursor:pointer;">
            <i class="bi bi-bell fs-5"></i>

            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </div>

        <ul class="dropdown-menu dropdown-menu-end">
            @forelse(auth()->user()->unreadNotifications as $notification)
                <li class="px-3 py-2">
                    {{ $notification->data['message'] ?? 'Notification' }}
                </li>
            @empty
                <li class="px-3 py-2 text-muted">No notifications</li>
            @endforelse
        </ul>
    </div>

    <!-- User -->
    <span>{{ auth()->user()->name }}</span>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-outline-light">Logout</button>
    </form>

</div>


</div>
