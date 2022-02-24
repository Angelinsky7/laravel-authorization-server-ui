<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Group Policy') }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden"
                 x-data>
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Policy.Policy.create')

                    {{-- <x-policy-ui-shared:input-group header="{{ _('Resource') }}">
                        <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource')" x-on:item-change="resourceChanged($event)" />
                        <x-policy-ui-form-field-error field="resource" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Scopes') }}">
                        <x-policy-ui-shared:many-selector id="scopes" name="scopes" :values="old('scopes')" />
                        <x-policy-ui-form-field-error field="scopes" />
                    </x-policy-ui-shared:input-group> --}}

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.policy.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">{{ _('Create') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
