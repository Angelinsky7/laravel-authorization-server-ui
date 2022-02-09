<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

enum ButtonType : string {
    case Basic = '';
    case Raised = 'raised';
    case Stroked = 'stroked';
    case Flat = 'flat';
    case Icon = 'icon';
    case MiniFab = 'mini-fab';
}
