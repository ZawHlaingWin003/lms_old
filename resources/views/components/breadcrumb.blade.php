@props(['navigations'])

<nav aria-label="breadcrumb" class="mb-5 d-inline-block px-4 py-2 bg-white">
    <ol class="breadcrumb mb-0">
        @foreach ($navigations as $navigation)
            @if ($navigation['active'] ==  true)
                <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: #004257;">
                    {{ $navigation['name'] }}
                </li>
            @else
                <li class="breadcrumb-item fw-bold">
                    <a href="{{ $navigation['route'] }}" style="color: #004257; text-decoration: none;">{{ $navigation['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>