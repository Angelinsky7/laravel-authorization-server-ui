<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Create a new Scope Permission') }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST">
            @csrf

            <div class="overflow-hidden"
                 x-data="{
                    resourceChanged(evt){
                        this.$dispatch('x-policy-ui-shared:many-selector-scopes:set-options', {options: evt.detail.option != null ? evt.detail.option.scopes.map(p => ({ value: p.id, caption: p.display_name })) : []});
                    }
                 }">
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Permission.Permission.create')

                    <x-policy-ui-shared:input-group header="{{ _('Resource') }}">
                        <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource')" x-on:item-change="resourceChanged($event)" />
                        <x-policy-ui-form-field-error field="resource" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Scopes') }}">
                        <x-policy-ui-shared:many-selector id="scopes" name="scopes" :values="old('scopes')" />
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
