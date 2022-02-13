<!-- x-policy-ui-shared:select -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-shared:select');
$unique_component_options = 'x_policy_ui_shared_select_' . $id . '_options_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_options }} = {!! json_encode($options ?? []) !!};
</script>
<div {{ $attributes }} x-data="window.policy.alpineJs.select({
    options: {{ $unique_component_options }}
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
                   x-on:keydown.enter.stop.prevent="selectOption(currentSelectedOption)"
                   x-on:keydown.arrow-up.prevent="focusPreviousOption()"
                   x-on:keydown.arrow-down.prevent="focusNextOption()"
                   class="policy-ui-autocomplete-input mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 disabled:bg-gray-300 disabled:select-none disabled:cursor-not-allowed"
                   data-placeholder="{{ $placeholder }}" aria-invalid="false" aria-required="{{ $required }}"
                   autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false"
                   aria-haspopup="true" {{ $attributes->has('disabled') ? 'disabled' : '' }} />
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
             x-on:keydown.enter.stop.prevent="selectOption(currentSelectedOption)"
             x-on:keydown.arrow-up.prevent="focusPreviousOption()"
             x-on:keydown.arrow-down.prevent="focusNextOption()"
             x-cloak>
            <template x-for="(option, index) in options" :key="index">
                <div class="policy-ui-autocomplete-option min-h-[29px] h-[29px] leading-[29px] whitespace-nowrap overflow-hidden text-ellipsis p-0 px-[10px] text-left no-underlines relative outline-none flex flex-row max-w-full box-border items-center select-none"
                     tabindex="0" role="option"
                     x-on:click="selectOption(option)"
                     x-bind:class="{'policy-ui-option-active': config.isOptionActive(focusedOptionIndex, index)}"
                     x-bind:data="option.value"
                     x-bind:disabled="config.isOptionDisabled(option)"
                     x-bind:aria-disabled="config.isOptionDisabled(option)">
                    <span x-text="option.caption"
                          class="inline-block flex-grow overflow-hidden text-ellipsis whitespace-nowrap leading-[29px] text-left"></span>
                </div>
            </template>
        </div>
    </div>
</div>
