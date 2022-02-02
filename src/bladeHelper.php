<?php

function darkink_lasui_abbreviate($text, $max)
{
    if (strlen($text) <= $max)
        return $text;
    return substr($text, 0, $max - 3) . '...';
}
