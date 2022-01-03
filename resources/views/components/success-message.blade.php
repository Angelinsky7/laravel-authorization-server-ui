@if (session('success_message'))
    <div class="fixed top-0 right-0 w-64 flex flex-col px-4 py-4">
        <div class="flex items-center justify-start bg-green-100 px-4 py-4 rounded shadow-md"
             x-data="{show : true}"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-10">
            <svg class="text-green-500 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm leading-5 text-green-800 font-bold">
                {{ session('success_message') }}
            </p>
        </div>
    </div>
@endif
