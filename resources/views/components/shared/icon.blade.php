<!-- x-policy-ui-shared:icon -->

@php
$include_path_icon = 'policy-ui::components.shared.icons.' . $slot;
$ICONSIZE = \Darkink\AuthorizationServerUI\View\Components\Shared\IconSize::class;
$BUTTONCOLOR = \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::class;

switch ($stroke) {
    case $ICONSIZE::Small:
        $stroke_width = 1;
        break;
    case $ICONSIZE::Normal:
        $stroke_width = 2;
        break;
    case $ICONSIZE::Big:
        $stroke_width = 4;
        break;
}
@endphp

@include($include_path_icon, [
    'attributes' => $attributes->class([
        'policy-ui-icon',
        'h-6 w-6' => $size == $ICONSIZE::Normal,
        'h-4 w-4' => $size == $ICONSIZE::Small,
        'h-10 w-10' => $size == $ICONSIZE::Big,
        'policy-ui-color-basic' => $color == $BUTTONCOLOR::Basic,
        'policy-ui-color-primary' => $color == $BUTTONCOLOR::Primary,
        'policy-ui-color-secondary' => $color == $BUTTONCOLOR::Secondary,
        'policy-ui-color-alert' => $color == $BUTTONCOLOR::Alert,
        'policy-ui-color-warning' => $color == $BUTTONCOLOR::Warning,
    ]),
    'size' => $size,
    'stroke' => $stroke_width
])
