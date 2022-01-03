<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Illuminate\View\Component;

class TableSearch extends Component
{
    use HasSearch;

    public string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('policy-ui::components.table-search', [
            'search' => request()->get(static::$SEARCH_KEY)
        ]);
    }
}
