<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <x-policy-ui-success-message />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-row items-center justify-end">
                        <x-policy-ui-table-search action="{{ route('policy-ui.permission.index') }}" />
                        <form action="{{ route('policy-ui.permission.create') }}" method="GET">
                            @csrf
                            <x-policy-ui-button-stroked color="blue" caption="Create new Permission" />
                        </form>
                    </div>

                    <div class="my-2"></div>

                    <x-policy-ui-table>
                        <x-slot name="header">
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <x-policy-ui-table-sort-header class="justify-start" column="name">
                                    {{ _('Name') }}
                                </x-policy-ui-table-sort-header>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <x-policy-ui-table-sort-header class="justify-start" column="description">
                                    {{ _('Description') }}
                                </x-policy-ui-table-sort-header>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Decision Strategy
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
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
                                            <div class="text-sm text-gray-500">{{ $item->label }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <x-policy-ui-permission:chip-decision-strategy :item="$item->decision_strategy" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <x-policy-ui-permission:chip-type :item="$item" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-policy-ui-dropdown>¨
                                                <x-slot name="trigger">
                                                    <x-policy-ui-button-dot></x-policy-ui-button-dot>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link
                                                                     :href="route('policy-ui.permission.edit', ['permission' => $item->id])">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                    <x-dropdown-link
                                                                     :href="route('policy-ui.permission.delete', ['permission' => $item->id])"
                                                                     data-remote data-modal>
                                                        {{ __('Delete') }}
                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-policy-ui-dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">
                                        <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No Role
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
