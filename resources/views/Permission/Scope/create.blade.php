<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Scope Permission') }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden" x-data="{
                resourceChanged(evt){
                    this.$dispatch('x-policy-ui-scope:many-selector-scopes:set-options', {scopes: evt.detail.option != null ? evt.detail.option.scopes : []});
                }
            }">
                <x-policy-ui-shared:inner-form-layout>
                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Description') }}">
                        <x-policy-ui-shared:input-textarea id="description" name="description" rows="3" placeholder="a simple description" value="{{ old('description') }}" />
                        <x-policy-ui-form-field-error field="description" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Decision Strategy') }}">
                        <x-policy-ui-permission:select-decision-strategy id="decision_strategy" autocomplete="decision_strategy-name"
                                                                         selectCaption="{{ _('--Select a decision strategy--') }}"
                                                                         :item="old('decision_strategy')" />
                        <x-policy-ui-form-field-error field="decision_strategy" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Resource') }}">
                        <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource')" x-on:item-change="resourceChanged($event)" />
                        <x-policy-ui-form-field-error field="resource" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Scopes') }}">
                        <x-policy-ui-scope:many-selector id="scopes" name="scopes" :values="old('scopes')" empty="true" />
                        <x-policy-ui-form-field-error field="scopes" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.permission.index') }}">Cancel</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">Create</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
