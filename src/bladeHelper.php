<?php

use Illuminate\Support\Collection;

function darkink_lasui_abbreviate($text, $max)
{
    if (strlen($text) <= $max)
        return $text;
    return substr($text, 0, $max - 3) . '...';
}

function old_with(string $key, Collection $src, string $column, callable $map)
{
    return old($key) != null ? array_values($src->whereIn($column, old($key))->map($map)->toArray()) : null;
}
