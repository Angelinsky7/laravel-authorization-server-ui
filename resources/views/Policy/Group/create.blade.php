<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Group Policy') }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden"
                 x-data>
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Policy.Policy.create')

                    {{-- <x-policy-ui-shared:input-group header="{{ _('Groups') }}">
                        <x-policy-ui-group:members id="groups" name="groups"
                                                   modalTitle="{{ _('Add group') }}" addCaption="{{ _('Add group') }}" removeCaption="{{ _('Remove group') }}"
                                                   :values="old('groups')" :remapOldValues="old('groups') != null"
                                                   :items="$all_groups">
                        </x-policy-ui-group:members>
                        <x-policy-ui-form-field-error field="groups" />
                    </x-policy-ui-shared:input-group> --}}

                    <x-policy-ui-shared:input-group header="{{ _('Groups') }}">
                        <x-policy-ui-group:entity-list id="groups" name="groups"
                                                       :values="old('groups')" :remapOldValues="old('groups') != null" />
                        <x-policy-ui-form-field-error field="groups" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.policy.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">{{ _('Create') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
