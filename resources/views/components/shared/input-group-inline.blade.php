<!-- x-policy-ui-shared:input-group-inline -->
<div {{ $attributes->merge(['class' => 'col-span-6 sm:col-span-6 flex']) }}>
    <div class="flex items-center p-1 flex-grow-0 {{ $reverse ? 'flex-row-reverse' : '' }}">
        <label for="description" class="block text-sm font-medium text-gray-700">
            {{ $header ?? $header_caption }}
        </label>
        <div class="{{ $reverse ? 'mr-2' : 'ml-2' }} -mt-1">
            {{ $slot }}
        </div>
    </div>
</div>
