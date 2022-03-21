<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use DateTime;
use Illuminate\View\Component;

class DatePicker extends Component
{

    public string $id;
    public string $name;
    public bool $time_visible;
    public string $input_mask;
    public string $input_format;
    public string $validation;
    public DateTime | string | int | null $value;

    public function __construct(
        string $id = '',
        string $name = '',
        bool $timeVisible = false,
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->time_visible = $timeVisible;
        $this->value = $value;

        $this->input_mask = $this->time_visible ? '__/__/____ __:__' : '__/__/____';
        $this->input_format = $this->time_visible ? 'dd/MM/yyyy HH:mm' : 'dd/MM/yyyy';
        $this->validation = $this->time_visible ? '([0-9◬]{2})\/(0[1-9◬]|1[0-2◬]|◬◬)\/([0-9◬]{4}) ([0-9◬]{2}):([0-9◬]{2})' : '([0-9◬]{2})\/(0[1-9◬]|1[0-2◬]|◬◬)\/([0-9◬]{4})';
    }

    public function render()
    {
        return view('policy-ui::components.shared.date-picker');
    }
}
