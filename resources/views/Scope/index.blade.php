<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Scopes') }}" />
    </x-slot>

    <x-policy-ui-success-message />

    <x-policy-ui-shared:outer-list-layout>
        <x-policy-ui-shared:default-list-actions>
            <x-policy-ui-table-search action="{{ route('policy-ui.scope.index') }}" />
            <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.scope.create') }}" class="ml-2">Create new Scope</x-policy-ui-shared:link>
        </x-policy-ui-shared:default-list-actions>

        <div class="my-2"></div>

        <x-policy-ui-table>
            <x-slot name="header">
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-start" column="name" header="{{ _('Name') }}" />
                </x-policy-ui-shared:default-table-header-column>
                <x-policy-ui-shared:default-table-header-column>
                    <x-policy-ui-shared:table-sort-header class="justify-center" column="icon_uri" header="{{ _('Icon URI') }}" />
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
                                <div class="text-sm text-gray-500">{{ darkink_lasui_abbreviate($item->display_name, 50) }}</div>
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-content class="w-[140px]">
                                <div class="flex flex-col items-center">
                                    @if (isset($item->icon_uri))
                                        <img src="{{ $item->icon_uri }}" width="32" height="32"
                                             alt="icon-uri" />
                                    @endif
                                </div>
                            </x-policy-ui-shared:default-table-row-content>
                            <x-policy-ui-shared:default-table-row-actions>
                                <x-policy-ui-shared:dropdown>¨
                                    <x-slot name="trigger">
                                        <x-policy-ui-shared:button genre="icon">
                                            <x-policy-ui-shared:icon size="small">dots-vertical</x-policy-ui-shared:icon>
                                        </x-policy-ui-shared:button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.scope.edit', ['scope' => $item->id])" content="{{ __('Edit') }}" />
                                        <x-policy-ui-shared:dropdown-link :href="route('policy-ui.scope.delete', ['scope' => $item->id])" data-remote data-modal content="{{ __('Delete') }}" />
                                    </x-slot>
                                </x-policy-ui-shared:dropdown>
                            </x-policy-ui-shared:default-table-row-actions>
                        </x-policy-ui-shared:default-table-row>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No scope found...</div>
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
