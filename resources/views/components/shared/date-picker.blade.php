<!-- x-policy-ui-shared:date-picker -->
<div x-data="window.policy.alpineJs.datePicker({
        value: '{{ $value }}'
    })">
    <div class="container mx-auto">
        <div class="w-64">
            <div class="relative">
                <input type="hidden" name="{{ $name }}" x-ref="date" x-bind:value="datepickerValue" />
                {{-- <input id="{{ $id }}"
                       type="text" class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                       placeholder="Select date" x-bind:readonly="config.onlySelect"
                       x-ref="control"
                       x-model="datepickerValue"
                       x-on:click="toggle()"
                       x-on:keydown.escape="showDatepicker = false" /> --}}

                <x-policy-ui-shared:input-mask id="{{ $id }}"
                                               class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                                               x-bind:readonly="config.onlySelect === true"
                                               data-js-datePickerControl
                                               x-on:click="toggle()"
                                               x-on:keydown="open()"
                                               x-on:keydown.escape="close()"
                                               x-on:blur="close()"
                                               mask="{{ $input_mask }}" validation="{{ $validation }}" />

                <div class="absolute top-0 right-0 px-3 py-2 mt-1">
                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <template x-teleport="#policy-ui-datepicker-container">
                    <div x-ref="panel">
                        <div class="bg-white rounded-lg shadow p-4 absolute"
                             x-cloak
                             x-show.transition="showDatepicker"
                             x-on:click.away="close()">

                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <span x-text="getMonthName(month)" class="text-lg font-bold text-gray-800"></span>
                                    <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                </div>
                                <div>
                                    <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                            x-on:click="previousDate()">
                                        <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                            x-on:click="nextDate()">
                                        <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-wrap mb-3 -mx-1">
                                <template x-for="(day, index) in getDays()" :key="index">
                                    <div class="px-0.5 w-[14.26%] h-[14.26%]">
                                        <div class="text-gray-800 font-medium text-center text-xs" x-text="day"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="flex flex-wrap -mx-1">
                                <template x-for="blankday in blankdays">
                                    <div class="text-center border p-1 border-transparent text-sm w-[14.28%] h-[14.28%]"></div>
                                </template>
                                <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                    <div class="px-1 mb-1 w-[14.28%] h-[14.28%]">
                                        <div class="cursor-pointer text-center text-sm leading-loose rounded-full transition ease-in-out duration-100"
                                             x-on:click="setDateValue(date)"
                                             x-text="date"
                                             x-bind:class="{
                                                'bg-indigo-200': isToday(date) == true,
                                                'text-gray-600 hover:bg-indigo-200': isToday(date) == false && isSelectedDay(date) == false,
                                                'bg-indigo-500 text-white hover:bg-opacity-75': isSelectedDay(date) == true
                                              }">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
