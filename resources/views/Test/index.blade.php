<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Test') }}" />
    </x-slot>

    <x-policy-ui-flash-message />

    <x-policy-ui-shared:outer-list-layout>

        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Client') }}">
                        <x-policy-ui-client:select id="client" name="client" :values="old('client')" :remapOldValues="old('client') != null"  />
                        <x-policy-ui-form-field-error field="client" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('User') }}">
                        <x-policy-ui-user:select id="user" name="user" :values="old('users')" :remapOldValues="old('user') != null"  />
                        <x-policy-ui-form-field-error field="user" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Mode') }}">
                        <x-policy-ui-common:select-evaluation-mode id="evaluation_mode" autocomplete="evaluation_mode-name" :item="old('evaluation_mode')"/>
                        <x-policy-ui-form-field-error field="mode" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Test') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>

            </div>
        </form>

    </x-policy-ui-shared:outer-list-layout>

</x-app-layout>
