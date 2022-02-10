<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit scope permission') }} {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-10 sm:mt-0">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form method="POST"
                                  action="{{ route('policy-ui.permission.update', ['permission' => $item->id]) }}">
                                @method('PUT')
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
                                                       value="{{ old('name') ?? $item->parent->name }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="name">
                                                </x-policy-ui-form-field-error>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Description
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="description" name="description" rows="3"
                                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                              placeholder="a simple description">{{ old('description') ?? $item->parent->description }}</textarea>
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
                                                                                                     :item="old('decision_strategy') ?? $item->parent->decision_strategy" />
                                                    <x-policy-ui-form-field-error field="decision_strategy" />
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description"
                                                       class="block text-sm font-medium text-gray-700">
                                                    Resource
                                                </label>
                                                <div class="mt-1">
                                                    {{ $item->resource }}
                                                    <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource') ?? $item->resource" />
                                                    <x-policy-ui-form-field-error field="resource" />

                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="description" class="block text-sm font-medium text-gray-700">
                                                    Scopes
                                                </label>
                                                <div class="mt-1">
                                                    <x-policy-ui-scope:many-selector id="scopes" name="scopes" :values="old('scopes') ?? $item->scopes" />
                                                    <x-policy-ui-form-field-error field="scopes" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="px-4 py-3 text-right sm:px-6">
                                        <x-policy-ui-shared:link href="{{ route('policy-ui.permission.index') }}">Cancel</x-policy-ui-shared:link>
                                        <x-policy-ui-shared:button genre="raised" color="primary" type="submit">Update</x-policy-ui-shared:button>
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
