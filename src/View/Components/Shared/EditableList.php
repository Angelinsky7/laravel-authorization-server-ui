<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class EditableList extends Component
{
    public string $id;
    public string $name;
    public string $placeholder;
    public bool $required;

    public string | null $panelMaxHeight;

    public array | null $dataSource;
    public array | null $selected;

    public function __construct(string $id, string $name, array | null $selected = null, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, array | null $dataSource = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;

        $this->dataSource = $dataSource;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('policy-ui::components.shared.editable-list');
    }
}
