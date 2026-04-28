<div class="header d-flex justify-content-between align-items-center">

    <h5 class="mb-0 text-info">Dashboard</h5>

    <div class="d-flex align-items-center gap-3">
        <i class="bi bi-bell"></i>

        <span>{{ auth()->user()->name }}</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>

    </div>


</div>
