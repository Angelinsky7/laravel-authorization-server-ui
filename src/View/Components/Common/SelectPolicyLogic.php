<?php

namespace Darkink\AuthorizationServerUI\View\Components\Common;

use Darkink\AuthorizationServer\Models\PolicyLogic;
use Illuminate\View\Component;

class SelectPolicyLogic extends Component
{
    public string $id;
    public string $autocomplete;
    public string $selectCaption;
    public PolicyLogic | null $item;

    public array $_items;

    public function __construct(string $id = '', string $autocomplete = '', string | null $selectCaption = null, PolicyLogic | null | string | int $item = null)
    {
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->selectCaption = $selectCaption ?? _('--Select a policy logic--');

        $this->item = (is_string($item) || is_int($item)) ? PolicyLogic::from($item) : $item;
        $this->_items = array_slice(PolicyLogic::cases(), 1);
    }

    public function render()
    {
        return view('policy-ui::components.shared.enum-select');
    }
}
