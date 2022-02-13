<!-- x-policy-ui-shared:link -->
@php
$BUTTONTYPE = \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::class;
$BUTTONCOLOR = \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::class;
@endphp
<a
   {{ $attributes->class([
           'policy-ui-link-base policy-ui-button-base',
           'policy-ui-button-basic' => $genre == $BUTTONTYPE::Basic,
           'policy-ui-button-raised' => $genre == $BUTTONTYPE::Raised,
           'policy-ui-button-stroked' => $genre == $BUTTONTYPE::Stroked,
           'policy-ui-button-flat' => $genre == $BUTTONTYPE::Flat,
           'policy-ui-button-icon' => $genre == $BUTTONTYPE::Icon,
           'policy-ui-button-mini-fab' => $genre == $BUTTONTYPE::MiniFab,
           'policy-ui-color-basic' => $color == $BUTTONCOLOR::Basic,
           'policy-ui-color-primary' => $color == $BUTTONCOLOR::Primary,
           'policy-ui-color-secondary' => $color == $BUTTONCOLOR::Secondary,
           'policy-ui-color-alert' => $color == $BUTTONCOLOR::Alert,
           'policy-ui-color-warning' => $color == $BUTTONCOLOR::Warning,
           'policy-ui-disabled' => $attributes->has('disabled'),
       ])->merge([]) }}>
    {{ $slot }}
</a>
