<?php

namespace Darkink\AuthorizationServerUI\View\Components\Group;

enum EntityListMode : string {
    case GROUP = 'group';
    case USER = 'user';
    case ALL = 'all';
}
