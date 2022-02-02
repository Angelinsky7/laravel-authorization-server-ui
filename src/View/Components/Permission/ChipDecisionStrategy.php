<?php

namespace Darkink\AuthorizationServerUI\View\Components\Permission;

use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\ResourcePermission;
use Darkink\AuthorizationServer\Models\ScopePermission;
use Illuminate\View\Component;

class ChipDecisionStrategy extends Component
{

    public DecisionStrategy $item;

    public function __construct(DecisionStrategy $item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('policy-ui::components.permission.chip-decision-strategy');
    }
}
