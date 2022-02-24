<!-- x-policy-ui-group:entity-list -->
<x-policy-ui-shared:entity-list id="{{ $id }}" name="{{ $name }}" :values="$values" :items="$items" :remapOldValues="$remapOldValues"
                                modalTitle="{{ $modalTitle }}" addCaption="{{ $addCaption }}" removeCaption="{{ $removeCaption }}"
                                addCancelCaption="{{ $addCancelCaption }}" addAddCaption="{{ $addAddCaption }}" deleteTitle="{{ $deleteTitle }}"
                                deleteContent="{{ $deleteContent }}" deleteActionCaption="{{ $deleteActionCaption }}"
                                addDialogTitle="{{ $addDialogTitle }}" deleteDialogTitle="{{ $deleteDialogTitle }}">
    <x-slot name="listbox_item_template">
        <template x-if="item.item.type == 'group'">
            <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user-group</x-policy-ui-shared:icon>
        </template>
        <template x-if="item.item.type == 'user'">
            <x-policy-ui-shared:icon class="mr-1 group-hover:text-white">user</x-policy-ui-shared:icon>
        </template>
        <span class="w-full" x-text="`${item.item.caption}`"></span>
    </x-slot>
</x-policy-ui-shared:entity-list>
