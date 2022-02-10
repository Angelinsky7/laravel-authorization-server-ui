<!-- x-policy-ui-permission:select-decision-strategy -->
<select id="{{ $id }}" name="{{ $id }}" autocomplete="{{ $autocomplete }}"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @if (!is_null($selectCaption))
        <option disabled>{{ $selectCaption }}</option>
    @endif
    @foreach ($_items as $p)
        <option value="{{ $p->value }}" {{ $item == $p ? 'selected' : '' }}>
            {{ $p->name }}
        </option>
    @endforeach
</select>
