<x-policy-ui-shared:input-group header="{{ _('Name') }}">
    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->parent->name }}" />
    <x-policy-ui-form-field-error field="name" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Description') }}">
    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->parent->description }}" />
    <x-policy-ui-form-field-error field="description" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Decision Strategy') }}">
    <x-policy-ui-permission:select-decision-strategy id="decision_strategy" autocomplete="decision_strategy-name"
                                                     selectCaption="{{ _('--Select a decision strategy--') }}"
                                                     :item="old('decision_strategy') ?? $item->parent->decision_strategy" />
    <x-policy-ui-form-field-error field="decision_strategy" />
</x-policy-ui-shared:input-group>
