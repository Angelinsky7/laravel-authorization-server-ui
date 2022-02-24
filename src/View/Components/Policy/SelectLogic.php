<?php

namespace Darkink\AuthorizationServerUI\View\Components\Policy;

use Darkink\AuthorizationServer\Models\PolicyLogic;
use Illuminate\View\Component;

class SelectLogic extends Component
{
    public string $id;
    public string $autocomplete;
    public string $selectCaption;
    public PolicyLogic | null $item;

    public array $_items;

    public function __construct(string $id, string $autocomplete, string $selectCaption, PolicyLogic | null | string | int $item)
    {
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->selectCaption = $selectCaption;

        $this->item = (is_string($item) || is_int($item)) ? PolicyLogic::from($item) : $item;
        $this->_items = array_slice(PolicyLogic::cases(), 1);
    }

    public function render()
    {
        return view('policy-ui::components.shared.enum-select');
    }
}
