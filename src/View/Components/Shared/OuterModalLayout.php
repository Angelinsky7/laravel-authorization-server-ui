<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class OuterModalLayout extends Component
{
    public mixed $modal;

    public function __construct()
    {
        $this->modal = request()->get('modal');
    }

    public function render()
    {
        return view('policy-ui::components.shared.outer-modal-layout');
    }
}
