<!-- x-policy-ui-shared:default-table-row-content -->
<td {{ $attributes->merge([
    'class' => 'px-6 py-4 whitespace-nowrap',
]) }}>
    {{ $content_caption ?? $slot }}
</td>
