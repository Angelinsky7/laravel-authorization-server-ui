@php
$FLASHMESSAGETYPE = \Darkink\AuthorizationServerUI\View\Components\FlashMessageType::class;
$FLASHMESSAGETSIZE = \Darkink\AuthorizationServer\Helpers\FlashMessageSize::class;
@endphp
@if (session('success_message') || session('error_message') || session('warning_message'))
    <div @class([
        'fixed top-0 right-0 flex flex-col px-4 py-4',
        'w-[256px]' => $size == $FLASHMESSAGETSIZE::BASIC,
        'w-[512px]' => $size == $FLASHMESSAGETSIZE::NORMAL,
        'w-[1024px]' => $size == $FLASHMESSAGETSIZE::BIG,
    ])>
        <div @class([
            'px-4 py-4 rounded shadow-md relative',
            'bg-green-100' => session('success_message'),
            'bg-red-100' => session('error_message'),
            'bg-yellow-100' => session('warning_message'),
        ])
             x-data="{show : true}"
             x-show="show"
             {!! $autoclose ? 'x-init="setTimeout(() => show = false, ' . $duration . ')"' : '' !!}
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-10">
            @if (!$autoclose)
                <div class="absolute top-0 right-0 mt-2 mr-2 flex justify-end">
                    <x-policy-ui-shared:button x-on:click="show = false" type="button" genre="icon" color="basic">
                        <x-policy-ui-shared:icon size='small'>x-circle</x-policy-ui-shared:icon>
                    </x-policy-ui-shared:button>
                </div>
            @endif
            <div class="flex items-center justify-start">
                <div>
                    @if ($type == $FLASHMESSAGETYPE::SUCCESS)
                        <x-policy-ui-shared:icon size='custom' class="text-green-500 mr-2 w-[40px]">check-circle</x-policy-ui-shared:icon>
                    @elseif ($type == $FLASHMESSAGETYPE::ERROR)
                        <x-policy-ui-shared:icon size='custom' class="text-red-500 mr-2 w-[40px]">x-circle</x-policy-ui-shared:icon>
                    @elseif ($type == $FLASHMESSAGETYPE::WARNING)
                        <x-policy-ui-shared:icon size='custom' class="text-yellow-500 mr-2 w-[40px]">exclamation</x-policy-ui-shared:icon>
                    @endif
                </div>
                <p @class([
                    'text-sm leading-5 font-bold',
                    'text-green-800' => session('success_message'),
                    'text-red-800' => session('error_message'),
                    'text-yellow-800' => session('warning_message'),
                ])>
                    {{ $message }}
                </p>
            </div>
            <x-policy-ui-shared:progress class="mt-2" />
        </div>
    </div>
@endif
