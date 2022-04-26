<!-- x-policy-ui-table-search -->
<form action="{{ $action }}" class="mb-1" method="GET"
      x-data="{ search: '{{ $search }}' }">
    <input type="hidden" name="search" x-model="search" />
    <input type="text" placeholder="search" x-model.debounce.250ms="search"
           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
           value="{{ $search }}" autocomplete="off" />
    <button type="submit" hidden></button>
</form>
