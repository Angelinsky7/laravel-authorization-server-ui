<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header=" {{ __('Create a new Policy') }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <div class="overflow-hidden">
            <div class="px-4 py-5 bg-white sm:p-6 flex flex-col">

                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'group']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new Group Policy</span>
                    </div>
                </x-policy-ui-shared:link>
                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'role']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new Role Policy</span>
                    </div>
                </x-policy-ui-shared:link>
                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'user']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new User Policy</span>
                    </div>
                </x-policy-ui-shared:link>
                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'client']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new Client Policy</span>
                    </div>
                </x-policy-ui-shared:link>
                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'time']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new Time Policy</span>
                    </div>
                </x-policy-ui-shared:link>
                <x-policy-ui-shared:link genre="raised" color="primary" href="{{ route('policy-ui.policy.create', ['type' => 'aggregated']) }}" class="m-2 w-[50%]">
                    <div class="flex items-center h-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="ml-2">Create new Aggregated Policy</span>
                    </div>
                </x-policy-ui-shared:link>

            </div>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
