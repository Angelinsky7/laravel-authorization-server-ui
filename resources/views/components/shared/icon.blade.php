<!-- x-policy-ui-shared:icon -->

@php
    $include_path_icon = 'policy-ui::components.shared.icons.' . $slot;
@endphp

@include($include_path_icon, [
    'attributes' => $attributes->class([
        'h-6 w-6' => $size == \Darkink\AuthorizationServerUI\View\Components\Shared\IconSize::Normal,
        'h-4 w-4' => $size == \Darkink\AuthorizationServerUI\View\Components\Shared\IconSize::Small,
        'h-10 w-10' => $size == \Darkink\AuthorizationServerUI\View\Components\Shared\IconSize::Big
    ]),
    'size' => $size
])
