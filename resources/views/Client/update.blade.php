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
                            <x-policy-ui-shared:input-group header="{{ _('Revoked') }}">
                                <div class="w-4">
                                    <x-policy-ui-shared:input-base id="revoked" name="revoked" type="checkbox" value="{{ old('revoked') ?? $item->revoked }}" />
                                </div>
                                <x-policy-ui-form-field-error field="revoked" />
                            </x-policy-ui-shared:input-group>
                        </x-policy-ui-shared:tab-item>
                        <x-policy-ui-shared:tab-item header="{{ _('Properties') }}">
                            <x-policy-ui-shared:input-group header="{{ _('Enabled') }}">
                                <div class="w-4">
                                    <x-policy-ui-shared:input-base id="enabled" name="enabled" type="checkbox" value="{{ old('enabled') ?? ($item->client != null ? $item->client->enabled : '') }}" />
                                </div>
                                <x-policy-ui-form-field-error field="enabled" />
                            </x-policy-ui-shared:input-group>
                            <x-policy-ui-shared:input-group header="{{ _('Client Id') }}">
                                <x-policy-ui-shared:input-base id="client_id" name="client_id" type="text" value="{{ old('client_id') ?? ($item->client != null ? $item->client->client_id : '') }}" />
                                <x-policy-ui-form-field-error field="client_id" />
                            </x-policy-ui-shared:input-group>
                            <x-policy-ui-shared:input-group header="{{ _('Require Client Secret') }}">
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
                                <x-policy-ui-shared:input-base id="policy_enforcement" name="policy_enforcement" type="text" value="{{ old('policy_enforcement') ?? ($item->client != null ? $item->client->policy_enforcement->value : '') }}" />
                                <x-policy-ui-form-field-error field="policy_enforcement" />
                            </x-policy-ui-shared:input-group>
                            <x-policy-ui-shared:input-group header="{{ _('Decision Strategy') }}">
                                <x-policy-ui-shared:input-base id="decision_strategy" name="decision_strategy" type="text" value="{{ old('decision_strategy') ?? ($item->client != null ? $item->client->decision_strategy->value : '') }}" />
                                <x-policy-ui-form-field-error field="decision_strategy" />
                            </x-policy-ui-shared:input-group>
                            <x-policy-ui-shared:input-group header="{{ _('Anaylyse mode enabled') }}">
                                <div class="w-4">
                                    <x-policy-ui-shared:input-base id="analyse_mode_enabled" name="analyse_mode_enabled" type="checkbox" value="{{ old('analyse_mode_enabled') ?? ($item->client != null ? $item->client->analyse_mode_enabled : '') }}" />
                                </div>
                                <x-policy-ui-form-field-error field="analyse_mode_enabled" />
                            </x-policy-ui-shared:input-group>
                        </x-policy-ui-shared:tab-item>
                    </x-policy-ui-shared:tab>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.client.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
