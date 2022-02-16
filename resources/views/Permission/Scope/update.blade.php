<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit scope permission') }} '{{ $item->parent->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.permission.update', ['permission' => $item->id, 'type' => 'scope']) }}">
            @method('PUT')
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $item->id }}" />

            <div class="overflow-hidden"
                 x-data="{
                    resourceChanged(evt){
                        this.$dispatch('x-policy-ui-shared:many-selector-scopes:set-options', {options: evt.detail.option != null ? evt.detail.option.scopes.map(p => ({ value: p.id, caption: p.display_name })) : []});
                    }
                 }">
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Permission.Permission.update', ['item' => $item->parent])

                    <x-policy-ui-shared:input-group header="{{ _('Resource') }}">
                        <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource') ?? $item->resource" x-on:item-change="resourceChanged($event)" aria-disabled="true" disabled />
                        <x-policy-ui-form-field-error field="resource" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Scopes') }}">
                        <x-policy-ui-shared:many-selector id="scopes" name="scopes" :values="old('scopes') ?? $item->scopes->map(fn($p) => $p->id)" />
                        <x-policy-ui-form-field-error field="scopes" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.permission.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
