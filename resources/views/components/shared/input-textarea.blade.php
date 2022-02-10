<!-- x-policy-ui-shared:input-textarea -->
<textarea {{ $attributes->class(['shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border rounded-md','border-gray-300' => !$errors->has($name),'border-red-500' => $errors->has($name)])->merge([]) }}
          name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
