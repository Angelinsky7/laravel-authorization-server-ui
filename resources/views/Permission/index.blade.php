<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Permissions') }}" />
    </x-slot>

    <x-policy-ui-success-message />

    <x-policy-ui-shared:outer-list-layout>
        <x-policy-ui-shared:default-list-actions>
            <x-policy-ui-table-search action="{{ route('policy-ui.permission.index') }}" />
            <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.permission.create') }}" class="ml-2">Create new Permission</x-policy-ui-shared:link>
        </x-policy-ui-shared:default-list-actions>

        <div class="my-2"></div>

        <x-policy-ui-table>
            <x-slot name="header">
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="name" header="{{ _('Name') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="description" header="{{ _('Description') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column content-class="justify-center">
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="decision_strategy" header="{{ _('Decision Strategy') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column content-class="justify-center" header="{{ _('Type') }}" />
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
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-content content="{{ darkink_lasui_abbreviate($item->description, 50) }}" />
                            <x-policy-ui-shared:default-table-row-content content-class="justify-center items-center">
                                <x-policy-ui-permission:chip-decision-strategy :item="$item->decision_strategy" />
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-content content-class="justify-center items-center">
                                <x-policy-ui-permission:chip-type :item="$item" />
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-actions>
                                <x-policy-ui-shared:dropdown>¨
                                    <x-slot name="trigger">
                                        <x-policy-ui-shared:button genre="icon">
                                            <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                        </x-policy-ui-shared:button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.permission.edit', ['permission' => $item->id])" content="{{ __('Edit') }}" />
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.permission.delete', ['permission' => $item->id])" data-remote data-modal content="{{ __('Delete') }}" />
                                    </x-slot>
                                </x-policy-ui-shared:dropdown>
                            </x-policy-ui-shared:default-table-row-actions>
                        </x-policy-ui-shared:default-table-row>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No permission found...</div>
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
