<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Scope Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-10 sm:mt-0">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form method="POST">
                                @csrf
                                <div>
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="name"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Name
                                                </label>
                                                <input type="text" name="name" id="name"
                                                       value="{{ old('name') }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="name" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Description
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="description" name="description" rows="3"
                                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                              placeholder="a simple description">{{ old('description') }}</textarea>
                                                    <x-policy-ui-form-field-error field="description" />
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Decision Strategy
                                                </label>
                                                <div class="mt-1">
                                                    <x-policy-ui-permission:select-decision-strategy id="decision_strategy"
                                                                                                     autocomplete="decision_strategy-name"
                                                                                                     selectCaption="{{ _('--Select a decision strategy--') }}"
                                                                                                     :item="old('decision_strategy')" />
                                                    <x-policy-ui-form-field-error field="decision_strategy" />
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Resource
                                                </label>
                                                <div class="mt-1">
                                                    <x-policy-ui-resource:select id="resource" name="resource"
                                                                                 :value="old('resource')" />
                                                    <x-policy-ui-form-field-error field="resource" />

                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Scopes
                                                </label>
                                                <div class="mt-1">

                                                    <input id="scopes[0]" name="scopes[]" type="hidden" value="1" />

                                                    <x-policy-ui-form-field-error field="scopes" />

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="px-4 py-3 text-right sm:px-6">
                                        <x-policy-ui-button-cancel route="{{ route('policy-ui.role.index') }}">Cancel
                                        </x-policy-ui-button-cancel>
                                        <x-policy-ui-button-submit>Create</x-policy-ui-button-submit>
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
