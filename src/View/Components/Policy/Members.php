<?php

namespace Darkink\AuthorizationServerUI\View\Components\Policy;

use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Illuminate\View\Component;

class Members extends Component
{

    private PolicyRepository $_policyRepository;

    public string $id;
    public string $name;
    public string $modalTitle;
    public mixed $items;
    public string $addCaption;
    public string $removeCaption;
    public mixed $values;
    public bool $remapOldValues;

    public function __construct(
        PolicyRepository $policyRepository,
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string $modalTitle = 'title',
        string $addCaption = 'add',
        string $removeCaption = 'remove',
        bool $remapOldValues = false
    ) {
        $this->_policyRepository = $policyRepository;

        $this->id = $id;
        $this->name = $name;
        $this->modalTitle = $modalTitle;
        $this->items = $items;
        $this->addCaption = $addCaption;
        $this->removeCaption = $removeCaption;
        $this->values = $values;
        $this->remapOldValues = $remapOldValues;

        $this->items = $this->_policyRepository->gets()->get()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);
    }

    public function render()
    {
        return view('policy-ui::components.policy.members');
    }
}
