<!-- x-policy-ui-shared:tab -->
<div {{ $attributes->merge(['class' => 'policy-ui-tab-panel w-full']) }} id="{{ $id }}" role="tab"
     x-data="window.policy.alpineJs.tab({})" x-transition>
    <header class="flex">
        {{ $slot }}
    </header>
    <main>
    </main>
</div>
