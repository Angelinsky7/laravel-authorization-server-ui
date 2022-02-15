<!-- x-policy-ui-shared:manage-list -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-shared:manage-list');
$unique_component_items = 'x_policy_ui_shared_manage_list_' . $id . '_items_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_items }} = {!! json_encode($items ?? []) !!};
</script>
<div {{ $attributes }}
     x-data="window.policy.alpineJs.manageList({items: {{ $unique_component_items }}})"
     x-id="['x-policy-ui-shared-manage-list']">
    <div class="values">
        <template x-for="(option, index) in items" :key="index">
            <input x-bind:id="getIdOrNameFieldValue('{{ $id }}', index)" x-bind:name="getIdOrNameFieldValue('{{ $id }}', index)" type="hidden" x-bind:value="option" />
        </template>
    </div>
    {{-- <div x-text="items"></div> --}}
    <div class="flex flex-col">
        <template x-for="(item, listItemIndex) in items" :key="listItemIndex">
            {{ $item_template }}
        </template>
    </div>
    <x-policy-ui-shared:button genre="raised" type="button" color="primary"
                               x-on:click="addItem()">
        {{ _('Add Parent') }}
    </x-policy-ui-shared:button>
</div>
