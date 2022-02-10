<!-- x-policy-ui-shared:input-base -->
<input {{ $attributes->class(['mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md','border-gray-300' => !$errors->has($name),'border-red-500' => $errors->has($name)])->merge([]) }}
       type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
