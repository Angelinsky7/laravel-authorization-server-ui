<?php

namespace Darkink\AuthorizationServerUI\View\Components\Common;

use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Illuminate\View\Component;

class SelectDecisionStrategyClient extends Component
{
    public string $id;
    public string $autocomplete;
    public string $selectCaption;
    public DecisionStrategy | null $item;

    public array $_items;

    public function __construct(string $id = '', string $autocomplete = '', string | null $selectCaption = null, DecisionStrategy | null | string | int $item = null)
    {
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->selectCaption = $selectCaption ?? _('--Select a decision strategy--');

        $this->item = (is_string($item) || is_int($item)) ? DecisionStrategy::from($item) : $item;
        $this->_items = array_slice(array_slice(DecisionStrategy::cases(), 1), 0, -1);
    }

    public function render()
    {
        return view('policy-ui::components.shared.enum-select');
    }
}
