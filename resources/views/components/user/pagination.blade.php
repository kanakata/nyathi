@props(['totalPages', 'currentPage'])
@if ($totalPages > 1)
    <nav {{ $attributes }} aria-label="Page navigation">
        <div class="page-btn prev">‹</div>
        @for ($i = 1; $i <= $totalPages; $i++)
            <div class="page-btn page {{ $i === $currentPage ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</div>
        @endfor
        <div class="page-btn next">›</div>
    </nav>
@endif
