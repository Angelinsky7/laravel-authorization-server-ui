<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-10 sm:mt-0">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form method="POST">
                                @csrf
                                <div class="overflow-hidden">
                                    <div class="px-4 py-5 bg-white sm:p-6 flex flex-col">

                                        <div class="m-2 px-4 py-5 border-2 border-black">
                                            <x-policy-ui-button-submit route="{{ route('policy-ui.permission.create-scope') }}">Create a new Scope Permission</x-policy-ui-button-submit>
                                        </div>

                                        <div class="m-2 px-4 py-5 border-2 border-black">
                                            <x-policy-ui-button-submit route="{{ route('policy-ui.permission.create-resource') }}">Create a new Resource Permission</x-policy-ui-button-submit>
                                        </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
