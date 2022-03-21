<!-- x-policy-ui-shared:time-picker -->
<div x-data="window.policy.alpineJs.timePicker({
        value: '{{ $value }}'
    })" class="flex items-center"
     x-on:focusin="_focusIn($event)"
     x-on:focusout="_focusOut($event)"
     {{ $attributes->class([])->merge([]) }}>

    <input type="text" maxlength="2"
           class="text-center py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50 max-w-[100px]"
           x-ref="hourCtrl"
           x-model="hour"
           x-on:beforeinput="_beforeHandleInput($event, 'hour', $refs.minuteCtrl, _regexHour)"
           x-on:keyup.right="_handleInput($event, 'hour', $refs.minuteCtrl)"
           autocomplete="off" />

    <span class="mx-2"> : </span>

    <input type="text" maxlength="2"
           class="text-center py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50 max-w-[100px]"
           x-ref="minuteCtrl"
           x-model="minute"
           x-on:beforeinput="_beforeHandleInput($event, 'minute', null, _regexMinute)"
           x-on:keyup.left="_autoFocusPrev($event, 'minute', $refs.hourCtrl)"
           x-on:keyup.backspace="_autoFocusPrev($event, 'minute', $refs.hourCtrl)"
           autocomplete="off"/>

</div>
