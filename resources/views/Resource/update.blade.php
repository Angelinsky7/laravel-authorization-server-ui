<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resource') }} {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-10 sm:mt-0">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form method="POST" action="{{ route('policy-ui.resource.update', ['resource' => $item->id]) }}">
                                @method('PUT')
                                @csrf
                                <div class="overflow-hidden">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="name"
                                                       class="block text-sm font-medium text-gray-700">
                                                    {{ _('Name') }}
                                                </label>
                                                <input type="text" name="name" id="name"
                                                       value="{{ old('name') ?? $item->name }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="name" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="label"
                                                       class="block text-sm font-medium text-gray-700">
                                                    {{ _('Display Name') }}
                                                </label>
                                                <input type="text" name="display_name" id="display_name"
                                                       value="{{ old('display_name') ?? $item->display_name }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md  {{ $errors->has('display_name') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="display_name" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="label"
                                                       class="block text-sm font-medium text-gray-700">
                                                    {{ _('Type') }}
                                                </label>
                                                <input type="text" name="type" id="type"
                                                       value="{{ old('type') ?? $item->type }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md  {{ $errors->has('type') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="type" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="label"
                                                       class="block text-sm font-medium text-gray-700">
                                                    {{ _('Icon URI') }}
                                                </label>
                                                <input type="text" name="icon_uri" id="icon_uri"
                                                       value="{{ old('icon_uri') ?? $item->icon_uri }}"
                                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md  {{ $errors->has('icon_uri') ? 'border-red-500' : 'border-gray-300' }}">
                                                <x-policy-ui-form-field-error field="icon_uri" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 text-right sm:px-6">
                                        <x-policy-ui-button-cancel route="{{ route('policy-ui.resource.index') }}">Cancel
                                        </x-policy-ui-button-cancel>
                                        <x-policy-ui-button-submit>Update</x-policy-ui-button-submit>
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
