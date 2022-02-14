<!-- x-policy-ui-shared:default-table-row-content -->
<td {{ $attributes->merge([
    'class' => 'px-6 py-4 whitespace-nowrap',
]) }}>
    <div @class([
        'flex',
        'flex-col' => $content_class == '' && !str_contains($content_class, 'flex-row'),
        $content_class => $content_class != '',
    ])>
        {{ $content_caption ?? $slot }}
    </div>
</td>
