<!-- x-policy-ui-role:chip-system -->
<span @class([
    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full select-none',
    'bg-green-100 text-green-800' => $item->system == false,
    'bg-purple-100 text-purple-800' => $item->system == true,
])>
    {{ $caption }}
</span>
