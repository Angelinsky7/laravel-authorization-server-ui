<div {{ $attributes }} x-data="window.policy.alpineJs.listBox({
    dataSource: {{ json_encode($dataSource) }}
})">
    <select name="{{ $name }}" multiple="multiple" class="w-full h-full">
        <option value="option1">Option1</option>
        <option value="option2">Option2</option>
        <option value="Option3">Option3</option>
    </select>

</div>
