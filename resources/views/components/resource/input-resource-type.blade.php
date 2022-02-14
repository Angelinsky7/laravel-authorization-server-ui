<!-- x-policy-ui-resource:input-resource-type -->
@php
$unique_component_num = \Darkink\AuthorizationServerUI\View\Directives\ComponentId::execute('x-policy-ui-resource:input-resource-type');
$unique_component_value = 'x_policy_ui_resource_input_resource_type_' . $id . '_value_' . $unique_component_num;
$unique_component_options = 'x_policy_ui_resource_input_resource_type_' . $id . '_resources_' . $unique_component_num;
@endphp

<script>
    var {{ $unique_component_value }} = '{!! $value !!}';
    var {{ $unique_component_options }} = {!! json_encode($resources ?? []) !!};
</script>
<div x-data="window.policy.alpineJs.resourceInputResourceType({ value: {{ $unique_component_value }}, resources: {{ $unique_component_options }} })">
    <template x-if="search">
        <div class="flex w-full my-3">
            <div class="w-full  text-white border-l-4 px-4 py-2"
                 x-bind:class="{
                     'bg-green-900 border-l-green-600': matches.length > 0,
                     'bg-yellow-600 border-l-yellow-300': matches.length == 0
                 }">
                <span class="leading-3 font-light" x-text="matchText"></span>
            </div>
        </div>
    </template>
    <x-policy-ui-shared:input-base x-model.debounce.250ms="search" id="{{ $id }}" name="{{ $name }}" type="text" autocomplete="off" value="{{ $value }}" />
</div>
