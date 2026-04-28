<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/backend/dashboard.css', 'resources/js/app.js'])

</head>

<body>

    <!-- Sidebar -->
    @include('backend._aside')

    <div class="content">

        <!-- Header -->
        {{-- <div class="header">
            <input type="text" class="form-control w-50" placeholder="Search...">

            <div class="user">
                <i class="bi bi-bell"></i>
                <i class="bi bi-person-circle fs-4"></i>
                <span>Admin</span>
            </div>
        </div> --}}
        @include('backend._header')

        <!-- Page Content -->
        <div class="p-4 animate__animated animate__fadeIn">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="footer">
            <small>© 2026 Your Dashboard - All rights reserved</small>
        </div>

    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>
</html>
