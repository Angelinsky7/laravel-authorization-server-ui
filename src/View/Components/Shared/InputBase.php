<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputBase extends Component
{

    public string $id;
    public string $name;
    public string $type;
    public string | null $value;

    public bool $is_checkbox = false;
    public bool $checked = false;

    public function __construct(
        string $id = '',
        string $name = '',
        string $type = 'text',
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;

        $this->is_checkbox = $type == "checkbox";

        if($this->is_checkbox){
            $this->value = '1';
            $this->checked = $value;
        }else{
            $this->value = $value;
        }
    }

    public function render()
    {
        return view('policy-ui::components.shared.input-base');
    }
}
