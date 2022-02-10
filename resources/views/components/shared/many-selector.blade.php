<!-- x-policy-ui-shared:many-selector -->
<div {{ $attributes }} x-data="window.policy.alpineJs.manySelector({
    options: {{ json_encode($options) }},
    values: {{ json_encode($values) }}
})">

    <div class="values">
        <template x-for="(option, index) in values" :key="index">
            <input x-bind:id="getIdOrNameFieldValue('{{$id}}', index)" x-bind:name="getIdOrNameFieldValue('{{$id}}', index)" type="hidden" x-bind:value="config.getOptionValue(option)" />
        </template>
    </div>

    <div class="flex flex-row w-full">
        <div class="flex-1 border rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-[1px]">
            <select x-ref="available_scopes"
                    x-model="available_scopes_selected"
                    name="available_scopes" multiple="multiple" class="w-full h-full border-none focus:border-none border-transparent focus:shadow-none focus:ring-transparent">
                <template x-for="(option, index) in options" :key="index">
                    <option x-bind:value="config.getOptionValue(option)">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="config.getOptionCaption(option)"></span>
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
            <select x-ref="selected_scopes"
                    x-model="selected_scopes_selected"
                    name="selected_scopes" multiple="multiple" class="w-full h-full border-none focus:border-none border-transparent focus:shadow-none focus:ring-transparent">
                <template x-for="(option, index) in values" :key="index">
                    <option x-bind:value="config.getOptionValue(option)">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="config.getOptionCaption(option)"></span>
                    </option>
                </template>
            </select>
        </div>

    </div>
</div>
