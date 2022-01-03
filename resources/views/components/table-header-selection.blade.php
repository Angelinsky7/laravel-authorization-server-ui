<th scope="col"
    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
    style="width: 20px;">
    <input type="checkbox" autocomplete="off" x-ref="allSelectionInput"
           x-on:input="toggleAll($event.target.checked, $el)" />
</th>
