<!-- x-policy-ui-shared:input-group -->
<div class="col-span-6 sm:col-span-6">
    <label for="description" class="block text-sm font-medium text-gray-700">
        {{ $header ?? $header_caption }}
    </label>
    <div class="mt-1">
        {{ $slot }}
    </div>
</div>
