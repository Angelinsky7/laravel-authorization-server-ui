<?php

namespace Darkink\AuthorizationServerUI\View\Components\Policy;

use Darkink\AuthorizationServer\Models\AggregatedPolicy;
use Darkink\AuthorizationServer\Models\ClientPolicy;
use Darkink\AuthorizationServer\Models\Policy;
use Darkink\AuthorizationServer\Models\GroupPolicy;
use Darkink\AuthorizationServer\Models\RolePolicy;
use Darkink\AuthorizationServer\Models\TimePolicy;
use Darkink\AuthorizationServer\Models\UserPolicy;
use Illuminate\View\Component;

class ChipType extends Component
{

    public Policy $item;
    public string $caption;
    public string $class_name;

    public function __construct(Policy $item)
    {
        $this->item = $item;
        $this->class_name = get_class($item->Policy);
        $this->caption = $this->getCaption($this->class_name);
    }

    protected function getCaption($fullClassName)
    {
        switch ($fullClassName) {
            case GroupPolicy::class:
                return _('Group Policy');
                break;
            case RolePolicy::class:
                return _('Role Policy');
                break;
            case UserPolicy::class:
                return _('User Policy');
                break;
            case ClientPolicy::class:
                return _('Client Policy');
                break;
            case TimePolicy::class:
                return _('Time Policy');
                break;
            case AggregatedPolicy::class:
                return _('Aggregated Policy');
                break;
        }
        return _('Policy') . '(' . $fullClassName . ')';
    }

    public function render()
    {
        return view('policy-ui::components.policy.chip-type');
    }
}
