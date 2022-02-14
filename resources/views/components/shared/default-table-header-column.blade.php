<th {{ $attributes->merge([
    'class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
]) }} scope="col">
    <div @class([
        'flex',
        $content_class => $content_class != '',
    ])>
        {{ $header_caption ?? $slot }}
    </div>
</th>
