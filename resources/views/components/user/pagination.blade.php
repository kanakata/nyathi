@php
    exit($totalPages)
@endphp
@props(['totalPages', 'currentPage'])
@if ($totalPages > 1)
    <nav class="pagination" aria-label="Page navigation">
        @if ($currentPage > 1)
            <div class="page-btn">‹</div>
        @endif

        @for ($i = 1; $i <= $totalPages; $i++)
            <div class="page-btn page {{ $i === $currentPage ? 'active' : '' }}" data-page="{{ $i }}">{{ $i }}</div>
        @endfor

        @if ($currentPage < $totalPages)
            <div class="page-btn">›</div>
        @endif
    </nav>
@endif
