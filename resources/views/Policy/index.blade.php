<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Policies') }}" />
    </x-slot>

    <x-policy-ui-flash-message />

    <x-policy-ui-shared:outer-list-layout>
        <x-policy-ui-shared:default-list-actions>
            <x-policy-ui-table-search action="{{ route('policy-ui.policy.index') }}" />
            <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create') }}" class="ml-2">Create new Policy</x-policy-ui-shared:link>
        </x-policy-ui-shared:default-list-actions>

        <div class="my-2"></div>

        <x-policy-ui-table>
            <x-slot name="header">
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="name" header="{{ _('Name') }}" />
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
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-content>
                                <x-policy-ui-shared:dropdown>
                                    <x-slot name="trigger">
                                        <x-policy-ui-shared:button genre="icon">
                                            <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                        </x-policy-ui-shared:button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.policy.edit', ['policy' => $item->id])" content="{{ __('Edit') }}" />
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.policy.delete', ['policy' => $item->id])" data-remote data-modal content="{{ __('Delete') }}" />
                                    </x-slot>
                                </x-policy-ui-shared:dropdown>
                            </x-policy-ui-shared:default-table-row-actions>
                        </x-policy-ui-shared:default-table-row>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No policy found...</div>
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
