<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <a href="{{ $sortLink }}" class="cursor-pointer select-none" role="button" aria-label="Sort by {{ $column }}">
        {{ $header_caption ?? $slot }}
    </a>
    @if ($column == $sortBy)
        @if ($sortDirection == 'sortByDesc')
            <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 x-description="arrow-narrow-down">
                <path fill-rule="evenodd"
                      d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
            </svg>
        @elseif ($sortDirection == 'sortByAsc')
            <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 x-description="arrow-narrow-up">
                <path fill-rule="evenodd"
                      d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                      clip-rule="evenodd" />
            </svg>
        @endif
    @else
        <div class="w-4 ml-2"></div>
    @endif
</div>
