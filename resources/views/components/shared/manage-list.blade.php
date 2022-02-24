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
        <template x-for="(item, index) in items" :key="item.index">
            <input type="hidden"
                   x-bind:id="getIdOrNameFieldValue('{{ $id }}', index)"
                   x-bind:name="getIdOrNameFieldValue('{{ $id }}', index)"
                   x-bind:value="item.value" />
        </template>
    </div>
    {{-- <div x-text="items"></div> --}}
    <div class="flex flex-col">
        <template x-for="(item, index) in items" :key="item.index">
            {{ $item_template }}
        </template>
    </div>
    <x-policy-ui-shared:button genre="raised" type="button" color="primary"
                               x-on:click="addItem()">
        {{ $addCaption }}
    </x-policy-ui-shared:button>
</div>
