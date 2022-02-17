<x-policy-ui-shared:outer-modal-layout modal="true">
    <div class="flex flex-row">
        <x-policy-ui-shared:default-modal-icon>
            <x-policy-ui-shared:icon color="{{ $iconColor }}" size="big">{{ $icon }}</x-policy-ui-shared:icon>
        </x-policy-ui-shared:default-modal-icon>

        <x-policy-ui-shared:inner-modal-layout>
            <x-policy-ui-shared:default-modal-title title="{{ $title }}" />
            <x-policy-ui-shared:default-modal-content>
                <p class="text-sm text-gray-500">
                    {{ $content }}
                </p>
            </x-policy-ui-shared:default-modal-content>
        </x-policy-ui-shared:inner-modal-layout>
    </div>

    <x-policy-ui-shared:default-modal-actions>
        <x-policy-ui-shared:button x-on:click="close(false)" type="button">{{ $cancelCaption }}</x-policy-ui-shared:button>
        <x-policy-ui-shared:button x-on:click="close(true)" genre="raised" color="{{ $actionColor }}" type="button">{{ $actionCaption }}</x-policy-ui-shared:button>
    </x-policy-ui-shared:default-modal-actions>
</x-policy-ui-shared:outer-modal-layout>
