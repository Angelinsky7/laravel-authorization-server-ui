<?php

namespace Darkink\AuthorizationServerUI\View\Components\Common;

use Darkink\AuthorizationServer\Http\Requests\Evaluator\EvaluatorRequestResponseMode;
use Darkink\AuthorizationServer\Models\PolicyLogic;
use Illuminate\View\Component;

class SelectEvaluationMode extends Component
{
    public string $id;
    public string $autocomplete;
    public string $selectCaption;
    public EvaluatorRequestResponseMode | null $item;

    public array $_items;

    public function __construct(string $id = '', string $autocomplete = '', string | null $selectCaption = null, EvaluatorRequestResponseMode | null | string | int $item = null)
    {
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->selectCaption = $selectCaption ?? _('--Select an evaluation mode--');

        $this->item = (is_string($item) || is_int($item)) ? EvaluatorRequestResponseMode::from($item) : $item;
        $this->_items = EvaluatorRequestResponseMode::cases();
    }

    public function render()
    {
        return view('policy-ui::components.shared.enum-select');
    }
}
