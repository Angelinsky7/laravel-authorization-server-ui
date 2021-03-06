<x-policy-ui-shared:input-group header="{{ _('Name') }}">
    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
    <x-policy-ui-form-field-error field="name" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Description') }}">
    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') }}" />
    <x-policy-ui-form-field-error field="description" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Logic') }}">
    <x-policy-ui-common:select-policy-logic id="logic" autocomplete="logic-name"
                                            :item="old('logic')" />
    <x-policy-ui-form-field-error field="logic" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Permissions') }}">
    <x-policy-ui-permission:entity-list id="permissions" name="permissions" :values="old('permissions')" :remapOldValues="old('permissions') != null" />
    <x-policy-ui-form-field-error field="permissions" />
</x-policy-ui-shared:input-group>
