<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit Resource Permission') }} {{ $item->name }}" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.permission.update', ['permission' => $item->id, 'type' => 'resource']) }}">
            @method('PUT')
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $item->id }}" />

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>

                    @include('policy-ui::Permission.Permission.update')

                    <x-policy-ui-shared:input-group header="{{ _('Resource Type') }}">
                        <x-policy-ui-resource:input-resource-type id="resource_type" name="resource_type" value="{{ old('resource_type') ?? $item->resource_type }}" />
                        {{-- <x-policy-ui-shared:input-base id="resource_type" name="resource_type" type="text" value="{{ old('resource_type') ?? $item->resource_type }}" /> --}}
                        <x-policy-ui-form-field-error field="resource_type" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Resource') }}">
                        <x-policy-ui-resource:select id="resource" name="resource" panelMaxHeight="max-h-[200px]" :value="old('resource') ?? $item->resource" />
                        <x-policy-ui-form-field-error field="resource" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link genre="stroked" href="{{ route('policy-ui.permission.index') }}">Cancel</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="flat" color="primary" type="submit">Update</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>

</x-app-layout>
