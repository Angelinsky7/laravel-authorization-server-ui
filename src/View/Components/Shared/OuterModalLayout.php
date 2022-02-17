<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class OuterModalLayout extends Component
{
    public mixed $modal;
    public LayoutSize $paddingSize;
    public LayoutSize $paddingExternalSize;

    public function __construct(
        bool | null $modal = null,
        LayoutSize | string $paddingSize = 'normal',
        LayoutSize | string $paddingExternalSize = 'normal'
    ) {
        $this->modal = $modal ?? request()->get('modal');
        $this->paddingSize = is_string($paddingSize) ? LayoutSize::tryFrom($paddingSize) : $paddingSize;
        $this->paddingExternalSize = is_string($paddingExternalSize) ? LayoutSize::tryFrom($paddingExternalSize) : $paddingExternalSize;
    }

    public function render()
    {
        return view('policy-ui::components.shared.outer-modal-layout');
    }
}
