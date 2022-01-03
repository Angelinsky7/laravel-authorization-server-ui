<?php

namespace Darkink\AuthorizationServerUI\Traits;

use Darkink\AuthorizationServer\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{
    protected static string $SEARCH_KEY = 'search';

    protected function getSearch()
    {
        return request()->get(static::$SEARCH_KEY);
    }

    protected function addSearchToQueryModel(Builder $query)
    {
        $search = $this->getSearch();
        if ($search) {

            $search = mb_strtolower(trim($search));
            preg_match_all('/(?:")((?:\\\\.|[^\\\\"])*)(?:")|(\S+)/', $search, $matches);
            $words = $matches[1];
            for ($i = 2; $i < count($matches); $i++) {
                $words = array_filter($words) + $matches[$i];
            }

            $model = $query->getModel();
            $searchableAttrs = method_exists($model, 'getSearchable') ? $model->getSearchable() : [];
            if (count($searchableAttrs) != 0) {
                $columns = implode(',', $searchableAttrs);
                $query->where(function ($query) use ($columns, $words) {
                    foreach ($words as $word) {
                        $query->orWhereRaw("CONCAT_WS('◬', $columns) LIKE '%$word%'");
                    }
                });
            }
        }
        return $query;
    }
}
