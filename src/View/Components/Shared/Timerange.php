<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\Foundation\Mix;
use Illuminate\View\Component;

class Timerange extends Component
{
    public string $id;
    public int | string | null $from;
    public int | string | null $to;
    public mixed $value;

    public function __construct(
        string $id = '',
        int | string | null $from = null,
        int | string | null $to = null,
        mixed $value = null
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.timerange');
    }
}
