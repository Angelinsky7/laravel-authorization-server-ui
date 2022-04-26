<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Role rights : ') . $role->name }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>

                    <div class="flex flex-col col-span-6 sm:col-span-6">
                        @forelse ($resources as $resource)
                            {{-- <details open class="border border-black m-2 p-2 w-full">
                                <summary>
                                    <input type="checkbox" id="permissions_{{ $resource->name }}_all" />
                                    <label for="permissions_{{ $resource->name }}_all"> {{ $resource->display_name }}</label>
                                </summary>
                                <div class="ml-[18px]">
                                    <ul class="flex flex-row flex-wrap">
                                        @forelse($resource->scopes as $scope)
                                            <li class="mr-2 w-1/5 min-w-fit">
                                                <input type="checkbox" id="permissions[{{ $resource->name }}◬{{ $scope->name }}]" name="permissions[{{ $resource->name }}◬{{ $scope->name }}]" />
                                                <label class="select-none" for="permissions[{{ $resource->name }}◬{{ $scope->name }}]"> {{ $scope->display_name }}</label>
                                            </li>
                                        @empty
                                            <li>No Scope found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </details> --}}

                            <fieldset class="border border-black m-2 p-2 w-full">
                                <legend>
                                    <input type="checkbox" id="permissions_{{ $resource->name }}_all" />
                                    <label class="select-none" for="permissions_{{ $resource->name }}_all"> {{ $resource->display_name }}</label>
                                </legend>
                                <div class="">
                                    <ul class="flex flex-row flex-wrap">
                                        @forelse($resource->scopes as $scope)
                                            <li class="mr-2 w-1/5 min-w-fit">
                                                @php
                                                    $permission_name = "{$resource->name}◬{$scope->name}";
                                                @endphp
                                                <input autocomplete="off" type="checkbox" id="permissions[{{ $permission_name }}]" name="permissions[{{ $permission_name }}]" {{ in_array($permission_name, $permissions) ? 'checked' : '' }} />
                                                <label class="select-none" for="permissions[{{ $permission_name }}]"> {{ $scope->display_name }}</label>
                                            </li>
                                        @empty
                                            <li>No Scope found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </fieldset>
                        @empty
                            <p>No Resource found.</p>
                        @endforelse
                    </div>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>

            </div>
        </form>

    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
