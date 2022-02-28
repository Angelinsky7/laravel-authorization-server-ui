<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Aggregate Policy') }} '{{ $item->parent->name }}'" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.policy.update', ['policy' => $item->id, 'type' => 'aggregate']) }}">
            @method('PUT')
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $item->id }}" />

            <div class="overflow-hidden"
                 x-data>
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Policy.Policy.update', ['item' => $item->parent])

                    <x-policy-ui-shared:input-group header="{{ _('Strategy') }}">
                        <x-policy-ui-policy:select-strategy id="decision_strategy" autocomplete="decision_strategy-name"
                                                            selectCaption="{{ _('--Select a Decision Strategy --') }}"
                                                            :item="old('decision_strategy') ?? $item->decision_strategy" />
                        <x-policy-ui-form-field-error field="decision_strategy" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Policies') }}">
                        <x-policy-ui-policy:entity-list id="policies" name="policies"
                                                        :values="old('policies')?? $item->policies->map(fn($p) => $p->id)" :remapOldValues="true" />
                        <x-policy-ui-form-field-error field="policies" />
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
