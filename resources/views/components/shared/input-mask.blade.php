<!-- x-policy-ui-shared:input-mask -->
<div role="group" class="flex border border-black w-64 pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
     x-data="window.policy.alpineJs.inputMask()">
    <input type="hidden" x-model="value" />
    <input class="border-none bg-none p-0 outline-none text-center"
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
           x-on:keyup.backspace="autoFocusPrev(year, $refs.monthCtrl)">
</div>
