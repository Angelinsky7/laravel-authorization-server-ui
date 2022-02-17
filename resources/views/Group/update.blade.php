<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Group') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.group.update', ['group' => $item->id]) }}">
            @method('PUT')
            @csrf
            <input id="id" name="id" value="{{ $item->id }}" type="hidden" />

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Display name') }}">
                        <x-policy-ui-shared:input-base id="display_name" name="display_name" type="text" value="{{ old('display_name') ?? $item->display_name }}" />
                        <x-policy-ui-form-field-error field="display_name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        {{-- <x-policy-ui-shared:input-base id="description" name="description" type="text" value="{{ old('description') ?? $item->description }}" /> --}}
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->description }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                    {{-- {{ json_encode($item->members()) }} --}}

                    {{-- {{ json_encode($item->memberOfs) }} --}}
                    {{-- {{ json_encode($item->memberOfs->map(fn($p) => ['value' => $p->id, 'item' => $p])) }} --}}

                    <x-policy-ui-shared:input-group header="{{ _('Members of') }}">
                        <template id="memberofs-add-dialog">
                            <x-policy-ui-shared:outer-modal-layout modal="true" padding-size="custom">
                                <div x-data="{
                                    _items: [],
                                    selectedItemChanged(event){ this._items = event.detail.items; },
                                    addButtonDisabled() { return this._items.length == 0; }
                                }">
                                    <div class="flex flex-row">
                                        <x-policy-ui-shared:inner-modal-layout>
                                            <x-policy-ui-shared:default-modal-title title="{{ _('Add member') }}" />
                                            <x-policy-ui-shared:default-modal-content>
                                                <x-policy-ui-shared:listbox class="flex-1 min-h-[200px] min-w-[400px]" :items="$all_groups" x-on:selected-items="selectedItemChanged($event)">
                                                    <x-slot name="item_template">
                                                        <span class="w-full" x-text="`${item.item.display_name}`"></span>
                                                    </x-slot>
                                                </x-policy-ui-shared:listbox>
                                            </x-policy-ui-shared:default-modal-content>
                                        </x-policy-ui-shared:inner-modal-layout>
                                    </div>

                                    <x-policy-ui-shared:default-modal-actions>
                                        <x-policy-ui-shared:button x-on:click="close({confirm: false, items: []})" type="button">{{ _('Cancel') }}</x-policy-ui-shared:button>
                                        <x-policy-ui-shared:button x-on:click="close({confirm: true, items: _items})" x-bind:disabled="addButtonDisabled()" genre="raised" color="primary" type="button">{{ _('Add') }}</x-policy-ui-shared:button>
                                    </x-policy-ui-shared:default-modal-actions>
                                </div>
                            </x-policy-ui-shared:outer-modal-layout>

                        </template>
                        <template id="memberofs-delete-dialog">
                            <x-policy-ui-dialog:default-confirmation-dialog title="{{ _('Remove member') }}"
                                                                            content="Are you sure you want to delete this member ? This action cannot be undone."
                                                                            actionCaption="{{ _('Delete') }}" />
                        </template>
                        <div class="flex" x-data="window.policy.components.group.memberOfControl({
                            id: 'memberofs',
                            add: {
                                title: '',
                                content: 'memberofs-add-dialog'
                            },
                            remove: {
                                title: '{{ _('Confirmation') }}',
                                content: 'memberofs-delete-dialog'
                            }
                        })">
                            <x-policy-ui-shared:listbox class="flex-1 min-h-[200px]"
                                                        id="memberOfs" name="memberOfs" :items="old_with('memberOfs', $item->memberOfs, 'id', fn($p) => ['value' => $p->id, 'item' => $p]) ?? $item->memberOfs->map(fn($p) => ['value' => $p->id, 'item' => $p])"
                                                        x-on:selected-items="selectedItemChanged($event)">
                                <x-slot name="item_template">
                                    <span class="w-full" x-text="`${item.item.display_name}`"></span>
                                </x-slot>
                            </x-policy-ui-shared:listbox>
                            <div class="flex flex-col ml-2">
                                <x-policy-ui-shared:button x-on:click="add()" genre="stroked" color="secondary" type="button">{{ _('Add member') }}</x-policy-ui-shared:button>
                                <x-policy-ui-shared:button x-on:click="remove()" class="mt-1" genre="stroked" color="secondary" type="button" x-bind:disabled="removeIsDisabled()">{{ _('Remove member') }}</x-policy-ui-shared:button>
                            </div>
                        </div>
                        <x-policy-ui-form-field-error field="memberOfs" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('members') }}">
                        <x-policy-ui-form-field-error field="members" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.group.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
