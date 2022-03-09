<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use DateTime;
use Illuminate\View\Component;

class DatePicker extends Component
{

    public string $id;
    public string $name;
    public DateTime | string | int | null $value;

    public function __construct(
        string $id = '',
        string $name = '',
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.date-picker');
    }
}
