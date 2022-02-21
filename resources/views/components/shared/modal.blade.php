<div x-data="{ show: false }"
     x-show="show"
     x-init="show = true"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform translate-x-10"
     x-trap.noscroll="show"
     role="dialog" aria-modal="true" aria-labelledby="modal-headline">

    <div class="fixed inset-0 bg-gray-500 opacity-50 z-40"></div>

    <div class="fixed inset-0 z-50 grid justify-center content-center">
        <div class="bg-white shadow-lg rounded-lg sm:mt-8 sm:mb-8 overflow-hidden">
            <div class="flex flex-col h-full justify-between modal">
                <main>
                    <div class="p-4 pb-0">
                        {{ $header }}
                    </div>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</div>
