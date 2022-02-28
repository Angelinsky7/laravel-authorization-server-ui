<!-- x-policy-ui-user:entity-list -->
<x-policy-ui-shared:entity-list id="{{ $id }}" name="{{ $name }}"
                                :values="$values" :items="$items"
                                :remapOldValues="$remapOldValues" :excludeAlreadyAddedItems="$excludeAlreadyAddedItems"
                                modalTitle="{{ $modalTitle }}" addCaption="{{ $addCaption }}" removeCaption="{{ $removeCaption }}"
                                addCancelCaption="{{ $addCancelCaption }}" addAddCaption="{{ $addAddCaption }}" deleteTitle="{{ $deleteTitle }}"
                                deleteContent="{{ $deleteContent }}" deleteActionCaption="{{ $deleteActionCaption }}"
                                addDialogTitle="{{ $addDialogTitle }}" deleteDialogTitle="{{ $deleteDialogTitle }}">
    <x-slot name="listbox_item_template">
        <span class="w-full" x-text="`${item.item.caption}`"></span>
    </x-slot>
</x-policy-ui-shared:entity-list>
