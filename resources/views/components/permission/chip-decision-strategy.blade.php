<!-- x-policy-ui-permission:chip-decision-strategy -->
@php
$DECISIONSTRATEGY = \Darkink\AuthorizationServer\Models\DecisionStrategy::class;
@endphp
<span @class([
    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full select-none',
    'bg-green-100 text-green-800' => $item == $DECISIONSTRATEGY::Unanimous,
    'bg-blue-100 text-blue-800' => $item == $DECISIONSTRATEGY::Affirmative,
    'bg-red-100 text-red-800' => $item == $DECISIONSTRATEGY::Consensus,
])>
    {{ _($item->name) }}
</span>
