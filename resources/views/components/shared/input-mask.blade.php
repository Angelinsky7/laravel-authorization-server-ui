<!-- x-policy-ui-shared:input-mask -->
<div role="group" x-data="window.policy.alpineJs.inputMask({
    value: '{!! $value !!}',
    mask: '{!! $mask !!}',
    validation: '{!! $validation !!}',
    placeholderChar: '{!! $placeholder_char !!}',
    validationCharReplacement: '{!! $validation_char_replacement !!}',
})">
    {{-- <input type="hidden" x-model="value" x-ref="modelCtrl" value="{{ $value }}" /> --}}
    <div class="relative">
        <input type="text" {{ $attributes->class(['mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md','border-gray-300' => !$errors->has($name),'border-red-500' => $errors->has($name)])->merge([]) }}
               name="{{ $name }}" id="{{ $id }}"
               value="{{ $value }}"
               x-ref="textCtrl" data-js-txtCtrl
               x-model="value"
               x-on:focusin="_focusIn()"
               x-on:beforeinput="_handleBeforeInput($event)"
               autocomplete="off" />
        {{-- <span class="text-policy-ui-alert-500" x-show="error != null" x-text="error"></span> --}}
    </div>
</div>
