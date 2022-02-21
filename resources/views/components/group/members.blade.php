<!-- x-policy-ui-group:members -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-group:members');
$unique_component_items = 'x_policy_ui_group_members_' . $id . '_items_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_items }} = {!! json_encode($items ?? []) !!};
</script>
<div x-data="{
    memberItems: {{ $unique_component_items }},
    remap: {{ json_encode($remapOldValues) }},
    listboxInit(event){
        if(this.remap){
            event.detail.handle = true;
            event.detail.items = this.memberItems.filter(p => event.detail.values.includes(p.value));
        }
    }
}">
    <template id="{{ $id }}-add-dialog">
        <x-policy-ui-shared:outer-modal-layout modal="true" padding-size="custom">
            <div x-data="{
            modalItems: [],
            selectedItemChanged(event){ this.modalItems = event.detail.items; },
            addButtonDisabled() { return this.modalItems.length == 0; },
        }">
                <div class="flex flex-row">
                    <x-policy-ui-shared:inner-modal-layout>
                        <x-policy-ui-shared:default-modal-title title="{{ $modalTitle }}" />
                        <x-policy-ui-shared:default-modal-content>
                            <x-policy-ui-shared:listbox class="flex-1 min-h-[200px] min-w-[400px]" :items="$items" x-on:selected-items="selectedItemChanged($event)">
                                <x-slot name="item_template">
                                    <template x-if="item.item.type == 'group'">
                                        <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user-group</x-policy-ui-shared:icon>
                                    </template>
                                    <template x-if="item.item.type == 'user'">
                                        <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user</x-policy-ui-shared:icon>
                                    </template>
                                    <span class="w-full" x-text="`${item.item.caption}`"></span>
                                </x-slot>
                            </x-policy-ui-shared:listbox>
                        </x-policy-ui-shared:default-modal-content>
                    </x-policy-ui-shared:inner-modal-layout>
                </div>

                <x-policy-ui-shared:default-modal-actions>
                    <x-policy-ui-shared:button x-on:click="close({confirm: false, items: []})" type="button">{{ _('Cancel') }}</x-policy-ui-shared:button>
                    <x-policy-ui-shared:button x-on:click="close({confirm: true, items: modalItems})" x-bind:disabled="addButtonDisabled()" genre="raised" color="primary" type="button">{{ _('Add') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:default-modal-actions>
            </div>
        </x-policy-ui-shared:outer-modal-layout>

    </template>
    <template id="{{ $id }}-delete-dialog">
        <x-policy-ui-dialog:default-confirmation-dialog title="{{ _('Remove member') }}"
                                                        content="Are you sure you want to delete this member ? This action cannot be undone."
                                                        actionCaption="{{ _('Delete') }}" />
    </template>
    <div class="flex"
         x-data="window.policy.components.group.memberOfControl({
        id: '{{ $id }}',
        add: {
            title: '',
            content: '{{ $id }}-add-dialog'
        },
        remove: {
            title: '{{ _('Confirmation') }}',
            content: '{{ $id }}-delete-dialog'
        }
    })">
        <x-policy-ui-shared:listbox class="flex-1 min-h-[200px] max-h-[400px]"
                                    id="{{ $id }}" name="{{ $name }}" :items="$values"
                                    x-on:initialized="listboxInit($event)"
                                    x-on:selected-items="selectedItemChanged($event)">
            <x-slot name="item_template">
                <template x-if="item.item.type == 'group'">
                    <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user-group</x-policy-ui-shared:icon>
                </template>
                <template x-if="item.item.type == 'user'">
                    <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user</x-policy-ui-shared:icon>
                </template>
                <span class="w-full" x-text="`${item.item.caption}`"></span>
            </x-slot>
        </x-policy-ui-shared:listbox>
        <div class="flex flex-col ml-2">
            <x-policy-ui-shared:button x-on:click="add()" genre="stroked" color="secondary" type="button">{{ $addCaption }}</x-policy-ui-shared:button>
            <x-policy-ui-shared:button x-on:click="remove()" class="mt-1" genre="stroked" color="secondary" type="button" x-bind:disabled="removeIsDisabled()">{{ $removeCaption }}</x-policy-ui-shared:button>
        </div>
    </div>
</div>
