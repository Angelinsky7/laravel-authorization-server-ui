<x-policy-ui-shared:input-group header="{{ _('Name') }}">
    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
    <x-policy-ui-form-field-error field="name" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Description') }}">
    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') }}" />
    <x-policy-ui-form-field-error field="description" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Logic') }}">
    <x-policy-ui-policy:select-logic id="logic" autocomplete="logic-name"
                                     selectCaption="{{ _('--Select a logic --') }}"
                                     :item="old('logic')" />
    <x-policy-ui-form-field-error field="logic" />
</x-policy-ui-shared:input-group>
