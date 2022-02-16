<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Delete Role') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-modal-layout>
        <form method="POST" action="{{ route('policy-ui.role.destroy', ['role' => $item->id]) }}">
            @method('DELETE')
            @csrf

            <div class="flex flex-row">
                <x-policy-ui-shared:default-modal-icon>
                    <x-policy-ui-shared:icon class="text-red-600" size="big">exclamation</x-policy-ui-shared:icon>
                </x-policy-ui-shared:default-modal-icon>

                <x-policy-ui-shared:inner-modal-layout>
                    <x-policy-ui-shared:default-modal-title title="{{ _('Delete role') }}" />
                    <x-policy-ui-shared:default-modal-content>
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this role '{{ $item->name }}' ? This
                            action cannot be undone.
                        </p>
                    </x-policy-ui-shared:default-modal-content>
                </x-policy-ui-shared:inner-modal-layout>
            </div>

            <x-policy-ui-shared:default-modal-actions>
                <x-policy-ui-shared:link href="{{ route('policy-ui.role.index') }}">Cancel</x-policy-ui-shared:link>
                <x-policy-ui-shared:button genre="raised" color="alert" type="submit">Delete</x-policy-ui-shared:button>
            </x-policy-ui-shared:default-modal-actions>

        </form>
    </x-policy-ui-shared:outer-modal-layout>
</x-app-layout>
