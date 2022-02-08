<div {{ $attributes }} x-data="window.policy.alpineJs.manySelector({
    options: {{ json_encode($options) }},
    values: {{ json_encode($values) }}
})">
    <div class="flex flex-row w-full">
        <div class="flex-1">
            <select x-ref="available_scopes"
                    x-model="available_scopes_selected"
                    name="available_scopes" multiple="multiple" class="w-full h-full">
                <template x-for="(option, index) in options" :key="index">
                    <option x-bind:value="option.value">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="option.caption"></span>
                    </option>
                </template>
            </select>
        </div>

        <div class="flex flex-col justify-center m-2">
            <x-policy-ui-button-icon x-on:click="addSelected()"
                                     x-bind:disabled="addSelectedIsDisabled()"
                                     class="disabled:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-blue-500 hover:text-blue-700 hover:border-blue-300 focus:text-blue-700 focus:border-blue-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </x-policy-ui-button-icon>
            <x-policy-ui-button-icon>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-blue-500 hover:text-blue-700 hover:border-blue-300 focus:text-blue-700 focus:border-blue-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </x-policy-ui-button-icon>
            <x-policy-ui-button-icon>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-blue-500 hover:text-blue-700 hover:border-blue-300 focus:text-blue-700 focus:border-blue-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </x-policy-ui-button-icon>
            <x-policy-ui-button-icon>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-blue-500 hover:text-blue-700 hover:border-blue-300 focus:text-blue-700 focus:border-blue-300"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </x-policy-ui-button-icon>
            </svg>

        </div>

        <div class="flex-1">
            <select x-ref="selected_scopes"
                    x-model="selected_scopes_selected"
                    name="selected_scopes" multiple="multiple" class="w-full h-full">
                <template x-for="(option, index) in values" :key="index">
                    <option x-bind:value="option.value">
                        <span class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"
                              x-text="option.caption"></span>
                    </option>
                </template>
            </select>
        </div>

    </div>
</div>
