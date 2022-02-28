@if ($field != '')
    @if ($errors->has($field))
        <!-- x-policy-ui-form-field-error -->
        <!-- TODO(demarco): we must add the subfields here -->
        @foreach ($errors->get($field) as $message)
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @endforeach
    @endif
@elseif ($js != '')
    @if ($errors->any())
        <!-- x-policy-ui-form-field-error -->
        <div x-id="['x-policy-ui-form-field-error']">
            <script x-html="`var ${($id('x-policy-ui-form-field-error').toString().replaceAll('-', '_'))} = ${JSON.stringify({{ json_encode($errors->getBags()) }})};`"></script>
            <div x-data="window.policy.alpineJs.formFieldError('x-policy-ui-form-field-error', {{ $js }})">
                <template x-if="has()">
                    <template x-for="(errorMessage, formFieldIndex) in get()" :key="formFieldIndex">
                        <p class="text-red-500 text-xs italic" x-text="errorMessage"></p>
                    </template>
                </template>
            </div>
        </div>
    @endif
@endif
