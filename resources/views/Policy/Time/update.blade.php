<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Time Policy') }} '{{ $item->parent->name }}'" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.policy.update', ['policy' => $item->id, 'type' => 'time']) }}">
            @method('PUT')
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $item->id }}" />

            <div class="overflow-hidden"
                 x-data>
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Policy.Policy.update', ['item' => $item->parent])

                    <x-policy-ui-shared:input-group header="{{ _('Not before') }}">
                        <x-policy-ui-shared:date-picker id="not_before" name="not_before"  :value="old('not_before') ?? $item->not_before" time-visible />
                        <x-policy-ui-form-field-error field="not_before" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Not after') }}">
                        <x-policy-ui-shared:date-picker id="not_after" name="not_after" :value="old('not_after') ?? $item->not_after" time-visible />
                        <x-policy-ui-form-field-error field="not_after" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Times') }}">

                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.policy.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
