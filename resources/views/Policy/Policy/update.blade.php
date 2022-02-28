<x-policy-ui-shared:input-group header="{{ _('Name') }}">
    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
    <x-policy-ui-form-field-error field="name" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Description') }}">
    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->description }}" />
    <x-policy-ui-form-field-error field="description" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Logic') }}">
    <x-policy-ui-policy:select-logic id="logic" autocomplete="logic-name"
                                     selectCaption="{{ _('--Select a logic --') }}"
                                     :item="old('logic') ?? $item->logic" />
    <x-policy-ui-form-field-error field="logic" />
</x-policy-ui-shared:input-group>

<x-policy-ui-shared:input-group header="{{ _('Permissions') }}">
    {{-- <x-policy-ui-permission:members id="permissions" name="permissions"
                                    modalTitle="{{ _('Add permission') }}" addCaption="{{ _('Add permission') }}" removeCaption="{{ _('Remove permission') }}"
                                    :values="old('permissions') ?? $item->permissions->map(fn($p) => $p->id)" :remapOldValues="true">
    </x-policy-ui-permission:members> --}}
    <x-policy-ui-permission:entity-list id="permissions" name="permissions" :values="old('permissions') ?? $item->permissions->map(fn($p) => $p->id)" :remapOldValues="true" />
    <x-policy-ui-form-field-error field="permissions" />
</x-policy-ui-shared:input-group>
