<!-- x-policy-ui-shared:many-selector -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-shared:many-selector');
$unique_component_options = 'x_policy_ui_shared_many_selector_' . $id . '_options_' . $unique_component_num;
$unique_component_values = 'x_policy_ui_shared_many_selector_' . $id . '_values_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_options }} = {!! json_encode($options ?? []) !!};
    var {{ $unique_component_values }} = {!! json_encode($values ?? []) !!};
</script>
<div {{ $attributes }}
     x-data="window.policy.alpineJs.manySelector({
        options: {{ $unique_component_options }},
        values: {{ $unique_component_values }}
    })"
     x-on:x-policy-ui-shared:many-selector-{{ $id }}:set-options.window="setOptions($event)">

    <div class="values">
        <template x-for="(option, index) in selected_options" :key="index">
            <input x-bind:id="getIdOrNameFieldValue('{{ $id }}', index)" x-bind:name="getIdOrNameFieldValue('{{ $id }}', index)" type="hidden" x-bind:value="option.value" />
        </template>
    </div>

    <div class="flex flex-row w-full">
        <div class="flex-1 border rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-[1px]">
            <select x-ref="available_options"
                    x-model="available_options_selected"
                    name="available_options" multiple="multiple" class="w-full h-full border-none focus:border-none border-transparent focus:shadow-none focus:ring-transparent">
                <template x-for="(option, index) in available_options" :key="index">
                    <option x-bind:value="option.value">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="option.caption"></span>
                    </option>
                </template>
            </select>
        </div>

        <div class="flex flex-col justify-center m-2">

            <x-policy-ui-shared:button genre="icon-hover" color="primary"
                                       x-on:click="addSelected()"
                                       x-bind:disabled="canAddSelected()">
                <x-policy-ui-shared:icon size="small">chevron-right</x-policy-ui-shared:icon>
            </x-policy-ui-shared:button>

            <x-policy-ui-shared:button genre="icon" color="primary"
                                       x-on:click="addAll()"
                                       x-bind:disabled="canAddAll()">
                <x-policy-ui-shared:icon size="small">chevron-double-right</x-policy-ui-shared:icon>
            </x-policy-ui-shared:button>

            <x-policy-ui-shared:button genre="icon" color="primary"
                                       x-on:click="removeAll()"
                                       x-bind:disabled="canRemoveAll()">
                <x-policy-ui-shared:icon size="small">chevron-double-left</x-policy-ui-shared:icon>
            </x-policy-ui-shared:button>

            <x-policy-ui-shared:button genre="icon" color="primary"
                                       x-on:click="removeSelected()"
                                       x-bind:disabled="canRemoveSelected()">
                <x-policy-ui-shared:icon size="small">chevron-left</x-policy-ui-shared:icon>
            </x-policy-ui-shared:button>

        </div>

        <div class="flex-1 border rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-[1px]">
            <select x-ref="selected_options"
                    x-model="selected_options_selected"
                    name="selected_options" multiple="multiple" class="w-full h-full border-none focus:border-none border-transparent focus:shadow-none focus:ring-transparent">
                <template x-for="(option, index) in selected_options" :key="index">
                    <option x-bind:value="option.value">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="option.caption"></span>
                    </option>
                </template>
            </select>
        </div>

    </div>
</div>
