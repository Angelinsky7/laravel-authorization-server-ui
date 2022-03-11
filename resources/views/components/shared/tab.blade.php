<!-- x-policy-ui-shared:tab -->
<div {{ $attributes->merge(['class' => 'policy-ui-tab-panel flex flex-col w-full']) }} id="{{ $id }}" role="tab"
     x-data="window.policy.alpineJs.tab({})">
    <div class="policy-ui-tab-headers flex flex-col relative">
        <div class="flex">
            {{ $slot }}
        </div>
        <div class="policy-ui-tab-header-bar absolute bottom-0 h-[2px] bg-policy-ui-primary-400 transition-width transition-left"
             x-bind:style="{left: `${headerBar.left}px`, width: `${headerBar.width}px`}">
        </div>
    </div>
    <div x-ref="tabItemsPanel" class="policy-ui-tab-main p-1 grid grid-cols-1 grid-rows-1">
    </div>
</div>
