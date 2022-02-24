<x-policy-ui-shared:input-group header="{{ _('Name') }}">
    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
    <x-policy-ui-form-field-error field="name" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Description') }}">
    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->description }}" />
    <x-policy-ui-form-field-error field="description" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Decision Strategy') }}">
    <x-policy-ui-permission:select-decision-strategy id="decision_strategy" autocomplete="decision_strategy-name"
                                                     selectCaption="{{ _('--Select a decision strategy--') }}"
                                                     :item="old('decision_strategy') ?? $item->decision_strategy" />
    <x-policy-ui-form-field-error field="decision_strategy" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Policies') }}">
    <x-policy-ui-policy:members id="policies" name="policies"
                               modalTitle="{{ _('Add policy') }}" addCaption="{{ _('Add policy') }}" removeCaption="{{ _('Remove policy') }}"
                               :values="old('policies') ?? $item->policies->map(fn($p) => $p->id)" :remapOldValues="true">
    </x-policy-ui-policy:members>
    <x-policy-ui-form-field-error field="policies" />
</x-policy-ui-shared:input-group>
