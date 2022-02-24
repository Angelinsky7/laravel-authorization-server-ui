<!-- x-policy-ui-shared:tab -->
<div {{ $attributes->merge([
    'class' => 'flex',
]) }} scope="tab-item"
     x-data="window.policy.alpineJs.tabItemRegister($data)">
    <div x-on:click="changeTab()"
         x-bind:class="{'tab-item--active': isActive(currentTabIndex)}"
         class="tabItem-header px-2 py-3 select-none hover:bg-policy-ui-primary-200 cursor-pointer">
        {{ $header_caption ?? $slot }}
    </div>
    <template id="main">
        <div class="tabItem-main" x-show="visible(currentTabIndex)" x-transition>
            {{ $slot }}
        </div>
    </template>
</div>
