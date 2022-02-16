<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Role') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.role.update', ['role' => $item->id]) }}">
            @method('PUT')
            @csrf
            <input id="id" name="id" value="{{ $item->id }}" type="hidden" />

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Display name') }}">
                        <x-policy-ui-shared:input-base id="display_name" name="display_name" type="text" value="{{ old('display_name') ?? $item->display_name }}" />
                        <x-policy-ui-form-field-error field="display_name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        {{-- <x-policy-ui-shared:input-base id="description" name="description" type="text" value="{{ old('description') ?? $item->description }}" /> --}}
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? $item->description }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Parents') }}">
                        <x-policy-ui-shared:manage-list id="parents" name="parents" :items="old('parents') ?? $item->parents->map(fn($p) => $p->id)">
                            <x-slot name="item_template">
                                <div class="flex mb-1">
                                    <div class="flex flex-col flex-1">
                                        <x-policy-ui-role:select class="flex-1" panelMaxHeight="max-h-[200px]"
                                                                 disableHiddenInput="true" initialValueControlFromJs="true"
                                                                 x-on:item-change="updateItem(index, $event.detail.option != null ? $event.detail.option.value : null)"
                                                                 x-on:initialize="$event.detail.option.value = items[index].value" />
                                        <x-policy-ui-form-field-error js="`parents.${index}`" />
                                    </div>
                                    <x-policy-ui-shared:button type="button" color="primary"
                                                               x-on:click="removeItem(index)">
                                        {{ _('Remove') }}
                                    </x-policy-ui-shared:button>
                                </div>
                            </x-slot>
                        </x-policy-ui-shared:manage-list>
                        <x-policy-ui-form-field-error field="parents" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.role.index') }}">Cancel</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">Update</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
