<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Permissions') }}" />
    </x-slot>

    <x-policy-ui-flash-message />

    <x-policy-ui-shared:outer-list-layout>
        <x-policy-ui-shared:default-list-actions>
            <x-policy-ui-shared:input-group header="{{ _('Show System Permission') }}" inline="true" reverse="true" class="mr-2">
                <div class="w-4" x-data="{
                    options: [],
                    init() {
                        let queryParams = new URLSearchParams(window.location.search);
                        if (queryParams.get('system') == '1') {
                            this.options.push('system');
                        }

                        console.log(this.options);

                        this.$watch('options', p => {
                            this._insertParam('system', p.includes('system') ? '1' : '0');
                        });
                    },
                    _insertParam(key, value) {
                        key = encodeURIComponent(key);
                        value = encodeURIComponent(value);
                        let kvp = document.location.search.substr(1).split('&');
                        let i = 0;
                        for (; i < kvp.length; i++) {
                            if (kvp[i].startsWith(key + '=')) {
                                let pair = kvp[i].split('=');
                                pair[1] = value;
                                kvp[i] = pair.join('=');
                                break;
                            }
                        }

                        if (i >= kvp.length) {
                            kvp[kvp.length] = [key, value].join('=');
                        }
                        let params = kvp.join('&');
                        document.location.search = params;
                    }
                }">
                    <input type="checkbox" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md','border-gray-300" value="system" x-model="options">
                </div>
            </x-policy-ui-shared:input-group>
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
                                @if (!$item->is_system)
                                    <x-policy-ui-shared:dropdown>
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
                                @endif
                            </x-policy-ui-shared:default-table-row-actions>
                        </x-policy-ui-shared:default-table-row>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">
                            <div class="flex items-center justify-center mb-2 mt-3 text-gray-500">No permission found...</div>
                        </td>
                    </tr>
                @endif
            </x-slot>
            <x-slot name="footer">
                {{ $items->links() }}
            </x-slot>
        </x-policy-ui-table>

    </x-policy-ui-shared:outer-list-layout>
</x-app-layout>
