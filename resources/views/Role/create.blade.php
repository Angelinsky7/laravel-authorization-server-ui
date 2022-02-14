<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Role') }}" />
    </x-slot>

    {{-- <x-policy-ui-shared:validation-error-helper /> --}}

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Label') }}">
                        <x-policy-ui-shared:input-base id="label" name="label" type="text" value="{{ old('label') }}" />
                        <x-policy-ui-form-field-error field="label" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        {{-- <x-policy-ui-shared:input-base id="description" name="description" type="text" value="{{ old('description') }}" /> --}}
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.role.index') }}">Cancel</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">Create</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
