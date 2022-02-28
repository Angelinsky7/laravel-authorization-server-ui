<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Client') }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>

                    <x-policy-ui-shared:tab class="col-span-6 sm:col-span-6">
                        <x-policy-ui-shared:tab-item header="{{ _('Oauth') }}">
                            Ouath
                        </x-policy-ui-shared:tab-item>
                        <x-policy-ui-shared:tab-item header="{{ _('Properties') }}">
                            Properties
                        </x-policy-ui-shared:tab-item>
                    </x-policy-ui-shared:tab>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.client.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Create') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
