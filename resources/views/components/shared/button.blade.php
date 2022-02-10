<!-- x-policy-ui-shared:button -->
<button
        {{ $attributes->class([
                'policy-ui-button-base',
                'policy-ui-button-basic' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::Basic,
                'policy-ui-button-raised' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::Raised,
                'policy-ui-button-stroked' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::Stroked,
                'policy-ui-button-flat' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::Flat,
                'policy-ui-button-icon' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::Icon,
                'policy-ui-button-icon-hover' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::IconHover,
                'policy-ui-button-mini-fab' => $genre == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonType::MiniFab,
                'policy-ui-color-basic' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::Basic,
                'policy-ui-color-primary' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::Primary,
                'policy-ui-color-secondary' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::Secondary,
                'policy-ui-color-alert' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::Alert,
                'policy-ui-color-warning' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::Warning,
                'policy-ui-disabled' => $attributes->has('disabled'),
            ])->merge([
                'type' => 'button',
            ]) }}>
    {{ $slot }}
</button>
