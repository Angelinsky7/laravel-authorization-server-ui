<!-- x-policy-ui-shared:tab -->
<div {{ $attributes->merge([
    'class' => 'flex',
]) }} scope="tab-item"
     x-data="window.policy.alpineJs.tabItemRegister($data)">
    <div x-on:click="changeTab()"
         x-bind:class="{'tab-item--active': isActive(currentTabIndex)}"
         class="tabItem-header px-2 py-3 select-none hover:bg-policy-ui-primary-200 cursor-pointer">
        {{ $header_caption ?? $header }}
    </div>
    <template id="main">
        <div class="policy-ui-tab-item" x-show="visible(currentTabIndex)"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90">
            {{ $slot }}
        </div>
    </template>
</div>
