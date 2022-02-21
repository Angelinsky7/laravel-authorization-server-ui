<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Role') }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Display Name') }}">
                        <x-policy-ui-shared:input-base id="display_name" name="display_name" type="text" value="{{ old('display_name') }}" />
                        <x-policy-ui-form-field-error field="display_name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        {{-- <x-policy-ui-shared:input-base id="description" name="description" type="text" value="{{ old('description') }}" /> --}}
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Parents') }}">
                        <x-policy-ui-shared:manage-list id="parents" name="parents" :items="old('parents')">
                            <x-slot name="item_template">
                                <div class="flex mb-1">
                                    <div class="flex flex-col flex-1">
                                        <x-policy-ui-role:select class="flex-1" panelMaxHeight="max-h-[200px]"
                                                                 disableHiddenInput="true" initialValueControlFromJs="true" jsId="window.policy.id('x_policy_ui_shared_select', index)"
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
                    <x-policy-ui-shared:link href="{{ route('policy-ui.role.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Create') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
