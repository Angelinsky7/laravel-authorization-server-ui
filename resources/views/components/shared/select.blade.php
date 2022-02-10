<!-- x-policy-ui-shared:select -->
<div {{ $attributes }} x-data="window.policy.alpineJs.select({
    options: {{ json_encode($options) }}
})"
     x-on:click.outside="closePanel()"
     x-on:keydown.escape="closePanel()">
    <div>
        <div class="relative">
            <input x-ref="input" id="{{ $id }}" name="{{ $name }}" type="hidden"
                   value="{{ $value }}" />
            <input x-ref="control"
                   type="text" aria-label="{{ $name }}"
                   x-model.debounce="search"
                   x-on:click="togglePanel()"
                   x-on:keydown.enter.stop.prevent="selectOption()"
                   x-on:keydown.arrow-up.prevent="focusPreviousOption()"
                   x-on:keydown.arrow-down.prevent="focusNextOption()"
                   class="policy-ui-autocomplete-input mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border-gray-300"
                   data-placeholder="{{ $placeholder }}" aria-invalid="false" aria-required="{{ $required }}"
                   autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false"
                   aria-haspopup="true" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mr-1">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </span>
        </div>
        <div x-ref="popup"
             x-show="panelVisible"
             @class([
                 'policy-ui-autocomplete-panel overflow-auto rounded-md flex flex-col border border-black shadow-black drop-shadow-autocomplete bg-white z-50',
                 $panelMaxHeight => $panelMaxHeight != null,
             ])
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-on:keydown.enter.stop.prevent="selectOption()"
             x-on:keydown.arrow-up.prevent="focusPreviousOption()"
             x-on:keydown.arrow-down.prevent="focusNextOption()"
             x-cloak>
            <template x-for="(option, index) in options" :key="index">
                <div class="policy-ui-autocomplete-option min-h-[29px] h-[29px] leading-[29px] whitespace-nowrap overflow-hidden text-ellipsis p-0 px-[10px] text-left no-underlines relative outline-none flex flex-row max-w-full box-border items-center select-none"
                     tabindex="0" role="option"
                     x-on:click="selectOption(option)"
                     x-bind:class="{'policy-ui-option-active': config.isOptionActive(focusedOptionIndex, index)}"
                     x-bind:data="config.getOptionValue(option)"
                     x-bind:disabled="config.isOptionDisabled(option)"
                     x-bind:aria-disabled="config.isOptionDisabled(option)">
                    <span x-text="config.getOptionCaption(option)"
                          class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"></span>
                </div>
            </template>
        </div>
    </div>
</div>

{{-- <div
     x-data="window.policy.alpineJs.select({
         data: { au: 'Australia', be: 'Belgium', cn: 'China', fr: 'France', de: 'Germany', it: 'Italy', mx: 'Mexico', es: 'Spain', tr: 'Turkey', gb: 'United Kingdom', 'us': 'United States' },
         emptyOptionsMessage: 'No countries match your search.',
         name: 'country',
         placeholder: 'Select a country'
     })"
     x-init="init()"
     @click.away="closeListbox()"
     @keydown.escape="closeListbox()"
     class="relative">
    <span class="inline-block w-full rounded-md shadow-sm">
        <button
                x-ref="button"
                @click="toggleListboxVisibility()"
                :aria-expanded="open"
                aria-haspopup="listbox"
                type="button"
                class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
            <span
                  x-show="!open"
                  x-text="value in options ? options[value] : placeholder"
                  :class="{ 'text-gray-500': ! (value in options) }"
                  class="block truncate"></span>

            <input
                   x-ref="search"
                   x-show="open"
                   x-model="search"
                   @keydown.enter.stop.prevent="selectOption()"
                   @keydown.arrow-up.prevent="focusPreviousOption()"
                   @keydown.arrow-down.prevent="focusNextOption()"
                   type="search"
                   class="w-full h-full form-control focus:outline-none p-0 border-none"
                   value="{{ $value->id }}" />

            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mr-1">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </span>
        </button>
    </span>

    <div
         x-show="open"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
        <ul
            x-ref="listbox"
            @keydown.enter.stop.prevent="selectOption()"
            @keydown.arrow-up.prevent="focusPreviousOption()"
            @keydown.arrow-down.prevent="focusNextOption()"
            role="listbox"
            :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
            tabindex="-1"
            class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
            <template x-for="(key, index) in Object.keys(options)" :key="index">
                <li
                    :id="name + 'Option' + focusedOptionIndex"
                    @click="selectOption()"
                    @mouseenter="focusedOptionIndex = index"
                    @mouseleave="focusedOptionIndex = null"
                    role="option"
                    :aria-selected="focusedOptionIndex === index"
                    :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                    class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                    <span x-text="Object.values(options)[index]"
                          :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                          class="block font-normal truncate"></span>

                    <span
                          x-show="key === value"
                          :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                          class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                  clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>

            <div
                 x-show="!Object.keys(options).length"
                 x-text="emptyOptionsMessage"
                 class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
        </ul>
    </div>
</div> --}}
