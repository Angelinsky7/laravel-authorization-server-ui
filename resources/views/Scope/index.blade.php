<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scopes') }}
        </h2>
    </x-slot>

    <x-policy-ui-success-message />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-row items-center justify-end">
                        <x-policy-ui-table-search action="{{ route('policy-ui.scope.index') }}" />
                        <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.scope.create') }}" class="ml-2">Create new Scope</x-policy-ui-shared:link>
                    </div>

                    <div class="my-2"></div>

                    <x-policy-ui-table>
                        <x-slot name="header">
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <x-policy-ui-shared:table-sort-header class="justify-start" column="name">
                                    {{ _('Name') }}
                                </x-policy-ui-shared:table-sort-header>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Icone URI
                            </th>
                            <th scope="col" class="relative px-6 py-3 w-1">
                                <span class="sr-only">Actions</span>
                            </th>
                        </x-slot>
                        <x-slot name="rows">
                            @if (count($items) != 0)
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $item->name }}</div>
                                            <div class="text-sm text-gray-500">
                                                {{ darkink_lasui_abbreviate($item->display_name, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (isset($item->icon_uri))
                                                <img src="{{ $item->icon_uri }}" width="32" height="32"
                                                     alt="icon-uri" />
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-policy-ui-shared:dropdown>¨
                                                <x-slot name="trigger">
                                                    <x-policy-ui-shared:button genre="icon">
                                                        <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                                    </x-policy-ui-shared:button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-policy-ui-shared:dropdown-link
                                                                     :href="route('policy-ui.scope.edit', ['scope' => $item->id])">
                                                        {{ __('Edit') }}
                                                    </x-policy-ui-shared:dropdown-link>
                                                    <x-policy-ui-shared:dropdown-link
                                                                     :href="route('policy-ui.scope.delete', ['scope' => $item->id])"
                                                                     data-remote data-modal>
                                                        {{ __('Delete') }}
                                                    </x-policy-ui-shared:dropdown-link>
                                                </x-slot>
                                            </x-policy-ui-shared:dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">
                                        <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No scope
                                            found...</div>
                                    <td>
                                </tr>
                            @endif
                        </x-slot>
                        <x-slot name="footer">
                            {{ $items->links() }}
                        </x-slot>
                    </x-policy-ui-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
