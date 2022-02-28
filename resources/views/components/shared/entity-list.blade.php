<!-- x-policy-ui-shared:entity-list -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-shared:entity-list');
$unique_component_items = 'x_policy_ui_shared_entity_list_' . $id . '_items_' . $unique_component_num;
$unique_component_excludes = 'x_policy_ui_shared_entity_list_' . $id . '_excludes_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_items }} = {!! json_encode($items ?? []) !!};
    var {{ $unique_component_excludes }} = {!! json_encode($excludes ?? []) !!};
</script>
<div x-data="window.policy.alpineJs.memberOfControl({
    memberItems: {{ $unique_component_items }},
    memberExcludeItems: {{ $unique_component_excludes }},
    remap: {{ json_encode($remapOldValues) }},
})">
    <template id="{{ $unique_component_items }}-{{ $id }}-add-dialog">
        <x-policy-ui-shared:outer-modal-layout modal="true" padding-size="custom">
            <div x-data="window.policy.alpineJs.dialogEntityListListBox({
                excludeAlreadyAddedItems: {{ json_encode($excludeAlreadyAddedItems) }},
                memberExcludeItems: modalData.exludeItems
            })">
                <div class="flex flex-row">
                    <x-policy-ui-shared:inner-modal-layout>
                        <x-policy-ui-shared:default-modal-title title="{{ $modalTitle }}" />
                        <x-policy-ui-shared:default-modal-content>
                            <x-policy-ui-shared:input-base x-model.debounce="search" class="mb-1" type="text" placeholder="search" />
                            <x-policy-ui-shared:listbox class="flex-1 min-h-[200px] min-w-[400px] max-h-[400px]" :items="$items"
                                                        x-on:initialize="dialogListboxInit($event)"
                                                        x-on:selected-items="selectedItemChanged($event)">
                                <x-slot name="item_template">
                                    {{ $listbox_item_template }}
                                </x-slot>
                            </x-policy-ui-shared:listbox>
                        </x-policy-ui-shared:default-modal-content>
                    </x-policy-ui-shared:inner-modal-layout>
                </div>

                <x-policy-ui-shared:default-modal-actions>
                    <x-policy-ui-shared:button x-on:click="close({confirm: false, items: []})" type="button">{{ $addCancelCaption }}</x-policy-ui-shared:button>
                    <x-policy-ui-shared:button x-on:click="close({confirm: true, items: modalItems})" x-bind:disabled="addButtonDisabled()" genre="raised" color="primary" type="button">{{ $addAddCaption }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:default-modal-actions>
            </div>
        </x-policy-ui-shared:outer-modal-layout>

    </template>
    <template id="{{ $unique_component_items }}-{{ $id }}-delete-dialog">
        <x-policy-ui-dialog:default-confirmation-dialog title="{{ $deleteTitle }}"
                                                        content="{{ $deleteContent }}"
                                                        actionCaption="{{ $deleteActionCaption }}" />
    </template>
    <div class="flex"
         x-data="window.policy.alpineJs.memberOfListbox({
        id: '{{ $id }}',
        add: {
            title: '{{ $addDialogTitle }}',
            content: '{{ $unique_component_items }}-{{ $id }}-add-dialog'
        },
        remove: {
            title: '{{ $deleteDialogTitle }}',
            content: '{{ $unique_component_items }}-{{ $id }}-delete-dialog'
        }
    })">
        <x-policy-ui-shared:listbox class="flex-1 min-h-[200px] max-h-[400px]"
                                    id="{{ $id }}" name="{{ $name }}" :items="$values"
                                    x-on:initialize="listboxInit($event)"
                                    x-on:items-changed="storeListboxItems($event)"
                                    x-on:selected-items="selectedItemChanged($event)">
            <x-slot name="item_template">
                {{ $listbox_item_template }}
            </x-slot>
        </x-policy-ui-shared:listbox>
        <div class="flex flex-col ml-2">
            <x-policy-ui-shared:button x-on:click="add()" genre="stroked" color="secondary" type="button">{{ $addCaption }}</x-policy-ui-shared:button>
            <x-policy-ui-shared:button x-on:click="remove()" class="mt-1" genre="stroked" color="secondary" type="button" x-bind:disabled="removeIsDisabled()">{{ $removeCaption }}</x-policy-ui-shared:button>
        </div>
    </div>
</div>
