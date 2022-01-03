<th scope="col"
    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
    <x-policy-ui-header-sort class="justify-start" column="name" sortBy="{{ $sortBy }}"
                             sortDirection="{{ $sortDirection }}">
        {{ $slot }}
    </x-policy-ui-header-sort>
</th>
