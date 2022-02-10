<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Resource') }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Display Name') }}">
                        <x-policy-ui-shared:input-base id="display_name" name="display_name" type="text" value="{{ old('display_name') }}" />
                        <x-policy-ui-form-field-error field="display_name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Type') }}">
                        <x-policy-ui-shared:input-base id="type" name="type" type="text" value="{{ old('type') }}" />
                        <x-policy-ui-form-field-error field="type" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Icon URI') }}">
                        <x-policy-ui-shared:input-base id="icon_uri" name="icon_uri" type="text" value="{{ old('icon_uri') }}" />
                        <x-policy-ui-form-field-error field="icon_uri" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Scopes') }}">
                        <x-policy-ui-scope:many-selector id="scopes" name="scopes" :values="old('scopes')" />
                        <x-policy-ui-form-field-error field="scopes" />
                    </x-policy-ui-shared:input-group>
                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.resource.index') }}">Cancel</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">Create</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
