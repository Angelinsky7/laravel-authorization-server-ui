<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Client') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:validation-error-helper />

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.client.update', ['client' => $item->id]) }}">
            @method('PUT')
            @csrf
            <input id="id" name="id" value="{{ $item->id }}" type="hidden" />

            <div class="overflow-hidden">

                <div x-data="{
                    all_resources_tab_visible: {!! json_encode($item->client != null && $item->client->all_resources ? true : false) !!},
                    all_scopes_tab_visible: {!! json_encode($item->client != null && $item->client->all_scopes ? true : false) !!},
                    all_roles_tab_visible: {!! json_encode($item->client != null && $item->client->all_roles ? true : false) !!},
                    all_groups_tab_visible: {!! json_encode($item->client != null && $item->client->all_groups ? true : false) !!},
                    all_policies_tab_visible: {!! json_encode($item->client != null && $item->client->all_policies ? true : false) !!},
                    all_permissions_tab_visible: {!! json_encode($item->client != null && $item->client->all_permissions ? true : false) !!},
                }">

                    <span x-text="all_resources_tab_visible"></span>
                    <span x-text="all_permissions_tab_visible"></span>

                    <x-policy-ui-shared:inner-form-layout>
                        <x-policy-ui-shared:tab class="col-span-6 sm:col-span-6">
                            <x-policy-ui-shared:tab-item header="{{ _('Oauth') }}">
                                <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                                    <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
                                    <x-policy-ui-form-field-error field="name" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('User') }}">
                                    <x-policy-ui-shared:input-base id="user_id" name="user_id" type="text" value="{{ old('user_id') ?? $item->user_id }}" />
                                    <x-policy-ui-form-field-error field="user_id" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Secret') }}">
                                    <x-policy-ui-shared:input-base id="secret" name="secret" type="password" />
                                    <x-policy-ui-form-field-error field="secret" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Provider') }}">
                                    <x-policy-ui-shared:input-base id="provider" name="provider" type="text" value="{{ old('provider') ?? $item->provider }}" />
                                    <x-policy-ui-form-field-error field="provider" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Redirect') }}">
                                    <x-policy-ui-shared:input-base id="redirect" name="redirect" type="text" value="{{ old('redirect') ?? $item->redirect }}" />
                                    <x-policy-ui-form-field-error field="redirect" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('personal_access_client') }}">
                                    <x-policy-ui-shared:input-base id="personal_access_client" name="personal_access_client" type="text" value="{{ old('personal_access_client') ?? $item->personal_access_client }}" />
                                    <x-policy-ui-form-field-error field="personal_access_client" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Client Password') }}">
                                    <x-policy-ui-shared:input-base id="password_client" name="password_client" type="password" value="{{ old('password_client') ?? $item->password_client }}" />
                                    <x-policy-ui-form-field-error field="password_client" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Revoked') }}" inline="true" reverse="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base id="revoked" name="revoked" type="checkbox" value="{{ old('revoked') ?? $item->revoked }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="revoked" />
                                </x-policy-ui-shared:input-group>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Properties') }}">
                                <x-policy-ui-shared:input-group header="{{ _('Enabled') }}" inline="true" reverse="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base id="enabled" name="enabled" type="checkbox" value="{{ old('enabled') ?? ($item->client != null ? $item->client->enabled : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="enabled" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Client Id') }}">
                                    <x-policy-ui-shared:input-base id="client_id" name="client_id" type="text" value="{{ old('client_id') ?? ($item->client != null ? $item->client->client_id : '') }}" />
                                    <x-policy-ui-form-field-error field="client_id" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Require Client Secret') }}" inline="true" reverse="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base id="require_client_secret" name="require_client_secret" type="checkbox" value="{{ old('require_client_secret') ?? ($item->client != null ? $item->client->require_client_secret : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="require_client_secret" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Client Name') }}">
                                    <x-policy-ui-shared:input-base id="client_name" name="client_name" type="text" value="{{ old('client_name') ?? ($item->client != null ? $item->client->client_name : '') }}" />
                                    <x-policy-ui-form-field-error field="client_name" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                                    <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') ?? ($item->client != null ? $item->client->description : '') }}" />
                                    <x-policy-ui-form-field-error field="description" />
                                </x-policy-ui-shared:input-group>

                                <x-policy-ui-shared:input-group header="{{ _('Client Uri') }}">
                                    <x-policy-ui-shared:input-base id="client_uri" name="client_uri" type="text" value="{{ old('client_uri') ?? ($item->client != null ? $item->client->client_uri : '') }}" />
                                    <x-policy-ui-form-field-error field="client_uri" />
                                </x-policy-ui-shared:input-group>

                                <x-policy-ui-shared:input-group header="{{ _('Policy Enforcement') }}">
                                    <x-policy-ui-common:select-policy-enforcement id="policy_enforcement" autocomplete="policy_enforcement-name"
                                                                                  :item="old('policy_enforcement') ?? ($item->client != null ? $item->client->policy_enforcement->value : '')" />
                                    <x-policy-ui-form-field-error field="policy_enforcement" />
                                </x-policy-ui-shared:input-group>

                                <x-policy-ui-shared:input-group header="{{ _('Decision Strategy') }}">
                                    <x-policy-ui-common:select-decision-strategy id="decision_strategy" autocomplete="decision_strategy-name"
                                                                                 :item="old('decision_strategy') ?? ($item->client != null ? $item->client->decision_strategy->value : '')" />
                                    <x-policy-ui-form-field-error field="decision_strategy" />
                                </x-policy-ui-shared:input-group>

                                <x-policy-ui-shared:input-group header="{{ _('Permission Splitter') }}">
                                    <x-policy-ui-shared:input-base id="permission_splitter" name="permission_splitter" type="text" value="{{ old('permission_splitter') ?? ($item->client != null ? $item->client->permission_splitter : '') }}"  maxlength="1" />
                                    <x-policy-ui-form-field-error field="permission_splitter" />
                                </x-policy-ui-shared:input-group>

                                <x-policy-ui-shared:input-group header="{{ _('Anaylyse mode enabled') }}" inline="true" reverse="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base id="analyse_mode_enabled" name="analyse_mode_enabled" type="checkbox" value="{{ old('analyse_mode_enabled') ?? ($item->client != null ? $item->client->analyse_mode_enabled : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="analyse_mode_enabled" />
                                </x-policy-ui-shared:input-group>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Options') }}">
                                <x-policy-ui-shared:input-group header="{{ _('All resources') }}" inline="true" reverse="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_resources_tab_visible" id="all_resources" name="all_resources" type="checkbox" value="{{ old('all_resources') ?? ($item->client != null ? $item->client->all_resources : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_resources" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('All scopes') }}" inline="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_scopes_tab_visible" id="all_scopes" name="all_scopes" type="checkbox" value="{{ old('all_scopes') ?? ($item->client != null ? $item->client->all_scopes : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_scopes" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('All roles') }}" inline="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_roles_tab_visible" id="all_roles" name="all_roles" type="checkbox" value="{{ old('all_roles') ?? ($item->client != null ? $item->client->all_roles : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_roles" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('All groups') }}" inline="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_groups_tab_visible" id="all_groups" name="all_groups" type="checkbox" value="{{ old('all_groups') ?? ($item->client != null ? $item->client->all_groups : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_groups" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('All policies') }}" inline="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_policies_tab_visible" id="all_policies" name="all_policies" type="checkbox" value="{{ old('all_policies') ?? ($item->client != null ? $item->client->all_policies : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_policies" />
                                </x-policy-ui-shared:input-group>
                                <x-policy-ui-shared:input-group header="{{ _('All permissions') }}" inline="true" reverse="true">
                                    <div class="w-4">
                                        <x-policy-ui-shared:input-base x-model="all_permissions_tab_visible" id="all_permissions" name="all_permissions" type="checkbox" value="{{ old('all_permissions') ?? ($item->client != null ? $item->client->all_permissions : '') }}" />
                                    </div>
                                    <x-policy-ui-form-field-error field="all_permissions" />
                                </x-policy-ui-shared:input-group>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Resources') }}" x-show="!all_resources_tab_visible" x-cloak>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Scopes') }}" x-show="!all_scopes_tab_visible" x-cloak>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Roles') }}" x-show="!all_roles_tab_visible" x-cloak>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Groups') }}" x-show="!all_groups_tab_visible" x-cloak>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Policies') }}" x-show="!all_policies_tab_visible" x-cloak>
                            </x-policy-ui-shared:tab-item>

                            <x-policy-ui-shared:tab-item header="{{ _('Permissions') }}" x-show="!all_permissions_tab_visible" x-cloak>
                                <x-policy-ui-shared:input-group>
                                    <x-policy-ui-permission:entity-list id="permissions" name="permissions" :values="old('permissions') ?? ($item->client != null ? $item->client->permissions->map(fn($p) => $p->id) : [])" :remapOldValues="true" />
                                    <x-policy-ui-form-field-error field="permissions" />
                                </x-policy-ui-shared:input-group>
                            </x-policy-ui-shared:tab-item>

                        </x-policy-ui-shared:tab>

                    </x-policy-ui-shared:inner-form-layout>

                </div>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.client.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
