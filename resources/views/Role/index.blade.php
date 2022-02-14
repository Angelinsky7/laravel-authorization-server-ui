<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Roles') }}" />
    </x-slot>

    <x-policy-ui-success-message />

    <x-policy-ui-shared:outer-list-layout>
        <x-policy-ui-shared:default-list-actions>
            <x-policy-ui-table-search action="{{ route('policy-ui.role.index') }}" />
            <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.role.create') }}" class="ml-2">Create new Role</x-policy-ui-shared:link>
        </x-policy-ui-shared:default-list-actions>

        <div class="my-2"></div>

        <x-policy-ui-table>
            <x-slot name="header">
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="name" header="{{ _('Name') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-center" column="description" header="{{ _('Description') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-center" column="type" header="{{ _('Type') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column>
                    <span class="sr-only">Actions</span>
                </x-policy-ui-shared:default-table-header-column>
            </x-slot>
            <x-slot name="rows">
                @if (count($items) != 0)
                    @foreach ($items as $item)
                        <x-policy-ui-shared:default-table-row>
                            <x-policy-ui-shared:default-table-row-content>
                                <div class="text-sm text-gray-900">{{ $item->name }}</div>
                                <div class="text-sm text-gray-500">{{ $item->label }}</div>
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-content>
                                <div class="text-sm text-gray-900">{{ $item->description }}</div>
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row>
                                @if ($item->system)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        System
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        User
                                    </span>
                                @endif
                            </x-policy-ui-shared:default-table-row>
                            <x-policy-ui-shared:default-table-row-actions>
                                <x-policy-ui-shared:dropdown>¨
                                    <x-slot name="trigger">
                                        <x-policy-ui-shared:button genre="icon">
                                            <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                        </x-policy-ui-shared:button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.role.edit', ['role' => $item->id])" content="{{ __('Edit') }}" />
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.role.delete', ['role' => $item->id])" data-remote data-modal content="{{ __('Delete') }}" />
                                    </x-slot>
                                </x-policy-ui-shared:dropdown>
                            </x-policy-ui-shared:default-table-row-actions>
                        </x-policy-ui-shared:default-table-row>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No role found...</div>
                        <td>
                    </tr>
                @endif
            </x-slot>
            <x-slot name="footer">
                {{ $items->links() }}
            </x-slot>
        </x-policy-ui-table>

    </x-policy-ui-shared:outer-list-layout>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <x-policy-ui-success-message />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-row items-center justify-end">
                        <x-policy-ui-table-search action="{{ route('policy-ui.role.index') }}" />
                        <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.role.create') }}" class="ml-2">Create new Role</x-policy-ui-shared:link>
                    </div>

                    <div class="my-2"></div>

                    <x-policy-ui-table>
                        <x-slot name="header">
                            <th role="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <x-policy-ui-shared:table-sort-header class="justify-start" column="name">
                                    {{ _('Name') }}
                                </x-policy-ui-shared:table-sort-header>
                            </th>
                            <th role="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <x-policy-ui-shared:table-sort-header class="justify-start" column="description">
                                    {{ _('Description') }}
                                </x-policy-ui-shared:table-sort-header>
                            </th>
                            <th role="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th role="col" class="relative px-6 py-3 w-1">
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
                                            @if ($item->system)
                                                <span
                                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    System
                                                </span>
                                            @else
                                                <span
                                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if (!$item->system)
                                                <x-policy-ui-shared:dropdown>¨
                                                    <x-slot name="trigger">
                                                        <x-policy-ui-shared:button genre="icon">
                                                            <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                                        </x-policy-ui-shared:button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <x-policy-ui-shared:dropdown-link
                                                                                          :href="route('policy-ui.role.edit', ['role' => $item->id])">
                                                            {{ __('Edit') }}
                                                        </x-policy-ui-shared:dropdown-link>
                                                        <x-policy-ui-shared:dropdown-link
                                                                                          :href="route('policy-ui.role.delete', ['role' => $item->id])"
                                                                                          data-remote data-modal>
                                                            {{ __('Delete') }}
                                                        </x-policy-ui-shared:dropdown-link>
                                                    </x-slot>
                                                </x-policy-ui-shared:dropdown>
                                            @endif
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
