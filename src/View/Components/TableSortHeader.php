<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Illuminate\View\Component;

class TableSortHeader extends Component
{

    use HasSorting;

    private const PAGINATOR_PAGE_KEY = 'page';

    public string $column;
    public string $sortLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column)
    {
        $this->column = $column;
        $this->sortBy = $this->getSortBy();
        $this->sortDirection = $this->getSortDirection();

        $this->sortLink = $this->createSortLink();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('policy-ui::components.table-sort-header');
    }

    protected function createSortLink()
    {
        $params = request()->all();
        $this->addQuery($params, static::$SORTBYASC_KEY, null);
        $this->addQuery($params, static::$SORTBYDESC_KEY, null);

        if ($this->sortDirection == null || $this->sortBy != $this->column) {
            $this->addQuery($params, static::$SORTBYASC_KEY, $this->column);
        } else if ($this->sortDirection == static::$SORTBYASC_KEY) {
            $this->addQuery($params, static::$SORTBYDESC_KEY, $this->column);
        }

        $this->addQuery($params, static::PAGINATOR_PAGE_KEY, null);
        return request()->fullUrlWithQuery($params);
    }

    protected function addQuery(array &$query, string $key, mixed $value)
    {
        $query[$key] = $value;
    }
}
