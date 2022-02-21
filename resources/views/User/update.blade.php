<x-app-layout>
    <x-slot name="header">
        <x-policy-ui-shared:default-header header="{{ __('Edit User') }} '{{ $item->name }}'" />
    </x-slot>

    <x-policy-ui-shared:outer-form-layout>
        <form method="POST" action="{{ route('policy-ui.user.update', ['user' => $item->id]) }}">
            @method('PUT')
            @csrf
            <input id="id" name="id" value="{{ $item->id }}" type="hidden" />

            <div class="overflow-hidden">
                <x-policy-ui-shared:inner-form-layout>

                    <x-policy-ui-shared:input-group header="{{ _('Name') }}">
                        <x-policy-ui-shared:input-base id="name" name="name" type="text" value="{{ old('name') ?? $item->name }}" />
                        <x-policy-ui-form-field-error field="name" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Email') }}">
                        <x-policy-ui-shared:input-base id="email" name="email" type="email" value="{{ old('email') ?? $item->email }}" />
                        <x-policy-ui-form-field-error field="email" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Password') }}">
                        <x-policy-ui-shared:input-base id="password" name="password" type="password" value="{{ old('password') }}" />
                        <x-policy-ui-form-field-error field="password" />
                    </x-policy-ui-shared:input-group>

                    <x-policy-ui-shared:input-group header="{{ _('Password confirmation') }}">
                        <x-policy-ui-shared:input-base id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" />
                        <x-policy-ui-form-field-error field="password_confirmation" />
                    </x-policy-ui-shared:input-group>

                </x-policy-ui-shared:inner-form-layout>

                <x-policy-ui-shared:actions-form-layout>
                    <x-policy-ui-shared:link href="{{ route('policy-ui.user.index') }}">{{ _('Cancel') }}</x-policy-ui-shared:link>
                    <x-policy-ui-shared:button genre="raised" color="primary" type="submit">{{ _('Update') }}</x-policy-ui-shared:button>
                </x-policy-ui-shared:actions-form-layout>
            </div>
        </form>
    </x-policy-ui-shared:outer-form-layout>
</x-app-layout>
