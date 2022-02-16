<!-- x-policy-ui-shared:listbox -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-shared:listbox');
$unique_component_items = 'x_policy_ui_shared_listbox_' . $id . '_items_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_items }} = {!! json_encode($items ?? []) !!};
</script>
<div {{ $attributes->merge([
    'class' => 'policy-ui-listbox focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border border-gray-300 disabled:bg-gray-300 disabled:select-none disabled:cursor-not-allowed overflow-auto',
]) }}
     x-data="window.policy.alpineJs.listbox({items: {{ $unique_component_items }}})"
     x-id="['x-policy-ui-shared-listbox']"
     x-on:click="deselectAllItems()"
     x-on:x-policy-ui-shared:listbox-{{ $id }}:add-items.window="addItems($event.detail)"
     x-on:x-policy-ui-shared:listbox-{{ $id }}:remove-items.window="removeItems($event.detail)">

    <div class="values">
        <template x-for="(item, index) in items" :key="item.index">
            <input type="hidden"
                   x-bind:id="getIdOrNameFieldValue('{{ $id }}', index)"
                   x-bind:name="getIdOrNameFieldValue('{{ $id }}', index)"
                   x-bind:value="item.value" />
        </template>
    </div>

    <div class="flex flex-col">
        <template x-for="(item, index) in items" :key="item.index">
            <div class="policy-ui-listbox-item min-h-[29px] h-[29px] leading-[29px] whitespace-nowrap overflow-hidden text-ellipsis p-0 px-[10px] text-left no-underlines relative outline-none flex flex-row max-w-full box-border items-center select-none"
                 tabindex="0" role="option"
                 x-on:click.stop="toggleItem($event, index, item)"
                 x-bind:class="{'policy-ui-item-active': isItemSelected(item)}"
                 x-bind:data="item.value"
                 x-bind:disabled="isItemDisabled(item)"
                 x-bind:aria-disabled="isItemDisabled(item)">
                {{ $item_template }}
            </div>
        </template>
    </div>
</div>
