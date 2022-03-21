<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Time Policy') }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden"
                 x-data>
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Policy.Policy.create')

                    <x-policy-ui-shared:input-group header="{{ _('Not before') }}">
                        <x-policy-ui-shared:date-picker id="not_before" name="not_before"  :value="old('not_before')" time-visible />
                        <x-policy-ui-form-field-error field="not_before" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Not after') }}">
                        <x-policy-ui-shared:date-picker id="not_after" name="not_after" :value="old('not_after')" time-visible />
                        <x-policy-ui-form-field-error field="not_after" />
                    </x-policy-ui-shared:input-group>

                   {{-- <x-policy-ui-shared:input-group header="test">
                        <x-policy-ui-shared:input-mask mask="__/__/____ __:__" validation="([0-9◬]{2})\/(0[1-9◬]|1[0-2◬]|◬◬)\/([0-9◬]{4}) ([0-9◬]{2}):([0-9◬]{2})"></x-policy-ui-shared:input-mask>
                    </x-policy-ui-shared:input-group> --}}

                     {{--  <x-policy-ui-shared:input-group header="test1">
                        <x-policy-ui-shared:input-mask mask="(+41) __ ___ __ __(suisse)" validation="\\\(\\\+41\\\) ([0-9◬]{2}) ([0-9◬]{3}) ([0-9◬]{2}) ([0-9◬]{2})\\\(suisse\\\)"></x-policy-ui-shared:input-mask>
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
