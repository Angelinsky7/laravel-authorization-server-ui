<!-- x-policy-ui-permission:chip-type -->
<span @class([
    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full select-none',
    'bg-green-100 text-green-800' =>
        $class_name == \Darkink\AuthorizationServer\Models\GroupPolicy::class,
    'bg-blue-100 text-blue-800' =>
        $class_name == \Darkink\AuthorizationServer\Models\RolePolicy::class,
    'bg-purple-100 text-purple-800' =>
        $class_name == \Darkink\AuthorizationServer\Models\UserPolicy::class,
    // 'bg-red-100 text-red-800' =>
    //     $class_name ==
    //     \Darkink\AuthorizationServer\Models\ResourcePermission::class,
])>
    {{ $caption }}
</span>
