<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new User') }}" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>

                    <x-policy-ui-shared:tab class="col-span-6 sm:col-span-6">
                        <x-policy-ui-shared:tab-item header="{{ _('User') }}">
                            <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                                <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
                                <x-policy-ui-form-field-error field="name" />
                            </x-policy-ui-shared:input-group>

                            <x-policy-ui-shared:input-group header="{{ _('Email') }}">
                                <x-policy-ui-shared:input-base id="email" name="email" type="email" value="{{ old('email') }}" />
                                <x-policy-ui-form-field-error field="email" />
                            </x-policy-ui-shared:input-group>

                            <x-policy-ui-shared:input-group header="{{ _('Password') }}">
                                <x-policy-ui-shared:input-base id="password" name="password" type="password" value="{{ old('password') }}" />
                                <x-policy-ui-form-field-error field="password" />
                            </x-policy-ui-shared:input-group>

                            <x-policy-ui-shared:input-group header="{{ _('Password confirmation') }}">
                                <x-policy-ui-shared:input-base id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" />
                                <x-policy-ui-form-field-error field="password_confirmation" />
                            </x-policy-ui-shared:input-group>
                        </x-policy-ui-shared:tab-item>
                        <x-policy-ui-shared:tab-item header="{{ _('Roles') }}">
                            <x-policy-ui-shared:manage-list id="roles" name="roles" addCaption="{{ _('Add Role') }}" :items="old('roles')">
                                <x-slot name="item_template">
                                    <div class="flex mb-1">
                                        <div class="flex flex-col flex-1">
                                            <x-policy-ui-role:select class="flex-1" panelMaxHeight="max-h-[200px]"
                                                                     disableHiddenInput="true" initialValueControlFromJs="true"
                                                                     x-on:item-change="updateItem(index, $event.detail.option != null ? $event.detail.option.value : null)"
                                                                     x-on:initialize="$event.detail.option.value = items[index].value" />
                                            <x-policy-ui-form-field-error js="`roles.${index}`" />
                                        </div>
                                        <x-policy-ui-shared:button type="button" color="primary"
                                                                   x-on:click="removeItem(index)">
                                            {{ _('Remove') }}
                                        </x-policy-ui-shared:button>
                                    </div>
                                </x-slot>
                            </x-policy-ui-shared:manage-list>
                            <x-policy-ui-form-field-error field="roles" />
                        </x-policy-ui-shared:tab-item>
                        <x-policy-ui-shared:tab-item header="{{ _('Members of') }}">
                            {{-- <x-policy-ui-group:members id="memberofs" name="memberofs"
                                                       modalTitle="{{ _('Add member') }}" addCaption="{{ _('Add member') }}" removeCaption="{{ _('Remove member') }}"
                                                       :values="old('memberofs')" remapOldValues="true"
                                                       :items="$all_groups">
                            </x-policy-ui-group:members>
                            <x-policy-ui-form-field-error field="memberofs" /> --}}

                            <x-policy-ui-group:entity-list id="memberofs" name="memberofs"
                                                           :values="old('memberofs')" :remapOldValues="old('memberofs') != null" />
                            <x-policy-ui-form-field-error field="memberofs" />
                        </x-policy-ui-shared:tab-item>
                    </x-policy-ui-shared:tab>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.user.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Create') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
