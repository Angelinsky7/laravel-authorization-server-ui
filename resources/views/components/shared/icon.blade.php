@php
$include_path_icon = 'icons/' . $slot;
// $content = require_once $include_path_icon;
@endphp

@include('include_path_icon', ['attributes' => $attributes]);
