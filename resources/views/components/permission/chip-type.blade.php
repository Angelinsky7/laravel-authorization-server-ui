<!-- x-policy-ui-permission:chip -->
<span @class([
    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full select-none',
    'bg-green-100 text-green-800' =>
        $class_name ==
        \Darkink\AuthorizationServer\Models\ScopePermission::class,
    'bg-red-100 text-red-800' =>
        $class_name ==
        \Darkink\AuthorizationServer\Models\ResourcePermission::class,
])>
    {{ $caption }}
</span>
