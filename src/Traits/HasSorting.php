<?php

namespace Darkink\AuthorizationServerUI\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSorting
{

    protected static string $SORTBYASC_KEY = 'sortByAsc';
    protected static string $SORTBYDESC_KEY = 'sortByDesc';

    public string | null $sortBy;
    public string | null $sortDirection;

    protected function getSortBy()
    {
        return (request()->get(static::$SORTBYASC_KEY) ?? request()->get(static::$SORTBYDESC_KEY)) ?? null;
    }

    protected function getSortDirection()
    {
        if (request()->has(static::$SORTBYASC_KEY)) {
            return static::$SORTBYASC_KEY;
        } else if (request()->has(static::$SORTBYDESC_KEY)) {
            return static::$SORTBYDESC_KEY;
        }
        return null;
    }

    protected function addOrderByToQueryModel(Builder $query)
    {
        $sortBy = $this->getSortBy();
        $sortDirection = $this->getSortDirection();

        if ($sortBy != null && $sortDirection != null) {
            $query = $query->orderBy($sortBy, $this->transformDirectionToDirection($sortDirection));
        }
        return $query;
    }

    private function transformDirectionToDirection(string $sortDirection)
    {
        if ($sortDirection == static::$SORTBYASC_KEY) {
            return 'asc';
        } else if ($sortDirection == static::$SORTBYDESC_KEY) {
            return 'desc';
        }
        return null;
    }
}
