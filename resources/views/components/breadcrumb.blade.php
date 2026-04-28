<nav aria-label="breadcrumb" class="bg-white border rounded-pill px-4 py-2 shadow-sm d-inline-block">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>

        @foreach ($links as $link)
            @if ($loop->last)
                <li class="breadcrumb-item active text-truncate" style="max-width: 150px;" aria-current="page">
                    {{ $link['name'] ?? '---' }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $link['url'] ?? '#' }}" class="text-decoration-none">{{ $link['name'] ?? '---' }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
