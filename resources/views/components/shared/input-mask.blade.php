<!-- x-policy-ui-shared:input-mask -->
<div role="group" x-data="window.policy.alpineJs.inputMask({
    value: '{!! $value !!}',
    mask: '{!! $mask !!}',
    validation: '{!! $validation !!}',
    placeholderChar: '{!! $placeholder_char !!}',
    validationCharReplacement: '{!! $validation_char_replacement !!}',
})">
    {{-- <input type="hidden" x-model="value" /> --}}
    <div class="relative">
        <input type="text" {{ $attributes->class(['mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md','border-gray-300' => !$errors->has($name),'border-red-500' => $errors->has($name)])->merge([]) }}
               name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
               x-ref="textCtrl"
               x-model="value"
               x-on:focusin="_focusIn()"
               x-on:beforeinput="_handleBeforeInput($event)" />
    </div>
    {{-- <input class="border-none bg-none p-0 outline-none text-center"
           size="2" maxLength="2"
           aria-label="day"
           x-ref="dayCtrl"
           x-model="day"
           x-on:input="_handleInput(day, $refs.monthCtrl)">
    <span class="opacity-1 transition-opacity">&ndash;</span>
    <input class="border-none bg-none p-0 outline-none text-center"
           maxLength="3" size="3"
           aria-label="month"
           x-ref="monthCtrl"
           x-model="month"
           x-on:input="_handleInput(month, $refs.yearCtrl)"
           x-on:keyup.backspace="autoFocusPrev(month, $refs.dayCtrl)">
    <span class="opacity-1 transition-opacity">&ndash;</span>
    <input class="border-none bg-none p-0 outline-none text-center"
           maxLength="4" size="4"
           aria-label="year"
           x-ref="yearCtrl"
           x-model="year"
           x-on:input="_handleInput($refs.yearCtrl)"
           x-on:keyup.backspace="autoFocusPrev(year, $refs.monthCtrl)"> --}}
</div>
