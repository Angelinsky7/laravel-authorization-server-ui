<?php

namespace Darkink\AuthorizationServerUI\View\Components\Permission;

use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Illuminate\View\Component;

class SelectDecisionStrategy extends Component
{
    public string $id;
    public string $autocomplete;
    public string $selectCaption;
    public DecisionStrategy | null $item;

    public array $_items;

    public function __construct(string $id, string $autocomplete, string $selectCaption, DecisionStrategy | null | string | int $item)
    {
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->selectCaption = $selectCaption;
        $this->item = (is_string($item) || is_int($item)) ? DecisionStrategy::from($item) : $item;

        $this->_items = array_slice(DecisionStrategy::cases(), 1);
    }

    public function render()
    {
        // return view('policy-ui::components.permission.select-decision-strategy');
        return view('policy-ui::components.shared.enum-select');
    }
}
