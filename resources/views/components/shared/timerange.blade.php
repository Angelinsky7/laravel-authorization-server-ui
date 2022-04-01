<!-- x-policy-ui-shared:timerange -->
<div class="flex flex-row items-center">
    <label for="description" class="block text-sm font-medium text-gray-700 mx-4">
        {{ _('From') }}
    </label>
    <x-policy-ui-shared:input-base id="{{ $id }}[from]" name="{{ $id }}[from]" type="number" value="{{ is_array($value) && array_key_exists('from', $value) ? $value['from'] : null }}" />
    <label for="description" class="block text-sm font-medium text-gray-700 mx-4">
        {{ _('To') }}
    </label>
    <x-policy-ui-shared:input-base id="{{ $id }}[to]" name="{{ $id }}[to]" type="number" value="{{ is_array($value) && array_key_exists('from', $value) ? $value['to'] : null }}" />
</div>
