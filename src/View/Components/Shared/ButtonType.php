<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

enum ButtonType : string {
    case Basic = 'basic';
    case Raised = 'raised';
    case Stroked = 'stroked';
    case Flat = 'flat';
    case Icon = 'icon';
    case IconHover = 'icon-hover';
    case MiniFab = 'mini-fab';
}
